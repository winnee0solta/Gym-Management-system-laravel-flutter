import 'package:gym_app/index.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Gym Management System',
      theme: ThemeData( 
          primaryColor: Color(0xFFff5959), //#ff5959
        accentColor: Color(0xFFfacf5a), //#facf5a
        visualDensity: VisualDensity.adaptivePlatformDensity,
      ),
      home: SplashScreen(),
    );
  }
}
 