import 'dart:io';

import 'package:gym_app/index.dart';

//splash screen
class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        color: Theme.of(context).primaryColor,
        child: Center(
          child: Center(
              child: Column(
            mainAxisSize: MainAxisSize.max,
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Text(
                'Gym Management Sys',
                style: TextStyle(
                    fontSize: 35.0, color: Theme.of(context).accentColor),
              ),
              SizedBox(
                height: 20.0,
              ),
              CircularProgressIndicator()
            ],
          )),
        ),
      ),
    );
  }

  @override
  void initState() {
    super.initState();
    checkIfAuthenticated();
  }

  //check auth
  void checkIfAuthenticated() async {
    //pop screens untill splash screen is 1st screen
    Navigator.of(context).popUntil((route) => route.isFirst);
    sleep(Duration(seconds: 4));
    //check if authenticated
    Authentication().check().then((logedin) {
      print(logedin);
      if (logedin) {
        //check user type
        Authentication().userType().then((type) {
          switch (type) {
            case 'trainer':
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => TrainerHomeScreen()),
              );
              break;
            case 'member':
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => MemberHome()),
              );
              break;
            default:
              //redirect to login screeen
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => AuthHomeScreen()),
              );
          }
        });
      } else {
        print('auth home');
        //got to auth home
        WidgetsBinding.instance.addPostFrameCallback((_) {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (context) => AuthHomeScreen()),
          );
        });
      }
    });

    // Navigator.pushReplacement(
    //       context,
    //       MaterialPageRoute(builder: (context) => AuthHomeScreen()),
    //     );
  }
}
