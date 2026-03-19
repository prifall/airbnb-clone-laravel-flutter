import 'package:easy_localization/easy_localization.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:hive_flutter/hive_flutter.dart';

import 'config/app_config.dart';
import 'config/router.dart';
import 'config/theme.dart';
import 'blocs/auth/auth_bloc.dart';
import 'blocs/booking/booking_bloc.dart';
import 'blocs/wishlist/wishlist_bloc.dart';
import 'repositories/auth_repository.dart';
import 'repositories/booking_repository.dart';
import 'repositories/wishlist_repository.dart';
import 'services/api_service.dart';
import 'services/storage_service.dart';
import 'services/notification_service.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Lock to portrait mode
  await SystemChrome.setPreferredOrientations([
    DeviceOrientation.portraitUp,
    DeviceOrientation.portraitDown,
  ]);

  // Status bar style
  SystemChrome.setSystemUIOverlayStyle(
    const SystemUiOverlayStyle(
      statusBarColor: Colors.transparent,
      statusBarIconBrightness: Brightness.dark,
    ),
  );

  // Firebase (push notifications)
  await Firebase.initializeApp();

  // Hive local storage
  await Hive.initFlutter();
  await StorageService.init();

  // Easy Localization
  await EasyLocalization.ensureInitialized();

  runApp(
    EasyLocalization(
      supportedLocales: AppConfig.supportedLocales,
      path: 'assets/translations',
      fallbackLocale: AppConfig.fallbackLocale,
      child: const MoonBnbApp(),
    ),
  );
}

class MoonBnbApp extends StatefulWidget {
  const MoonBnbApp({super.key});

  @override
  State<MoonBnbApp> createState() => _MoonBnbAppState();
}

class _MoonBnbAppState extends State<MoonBnbApp> {
  late final NotificationService _notificationService;

  @override
  void initState() {
    super.initState();
    _notificationService = NotificationService();
    _notificationService.init();
  }

  @override
  Widget build(BuildContext context) {
    return MultiRepositoryProvider(
      providers: [
        RepositoryProvider(create: (_) => ApiService()),
        RepositoryProvider(create: (_) => StorageService()),
        RepositoryProvider(
          create: (ctx) => AuthRepository(api: ctx.read<ApiService>()),
        ),
        RepositoryProvider(
          create: (ctx) => BookingRepository(api: ctx.read<ApiService>()),
        ),
        RepositoryProvider(
          create: (ctx) => WishlistRepository(api: ctx.read<ApiService>()),
        ),
      ],
      child: MultiBlocProvider(
        providers: [
          BlocProvider(
            create: (ctx) => AuthBloc(
              authRepository: ctx.read<AuthRepository>(),
              storageService: ctx.read<StorageService>(),
            )..add(AuthCheckRequested()),
            lazy: false,
          ),
          BlocProvider(
            create: (ctx) => BookingBloc(
              bookingRepository: ctx.read<BookingRepository>(),
            ),
          ),
          BlocProvider(
            create: (ctx) => WishlistBloc(
              wishlistRepository: ctx.read<WishlistRepository>(),
            ),
          ),
        ],
        child: MaterialApp.router(
          title: AppConfig.appName,
          debugShowCheckedModeBanner: false,

          // Theme
          theme: MoonBnbTheme.light,
          darkTheme: MoonBnbTheme.dark,
          themeMode: ThemeMode.light,

          // Routing (go_router)
          routerConfig: AppRouter.router,

          // Localization
          localizationsDelegates: context.localizationDelegates,
          supportedLocales: context.supportedLocales,
          locale: context.locale,
        ),
      ),
    );
  }
}
