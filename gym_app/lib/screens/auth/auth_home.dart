import 'package:gym_app/index.dart';

class AuthHomeScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        height: MediaQuery.of(context).size.height,
        color: Theme.of(context).primaryColor,
        child: Center(
          child: Center(
              child: Column(
            mainAxisSize: MainAxisSize.max,
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Padding(
                padding: const EdgeInsets.only(left: 28.0, right: 28.0),
                child: MaterialButton(
                  minWidth: double.infinity,
                  onPressed: () {
                    // if (!logingin) _loginUser();
                    //member login page
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => MemberLoginScreen()),
                    );
                  },
                  color: Colors.black,
                  child: Padding(
                    padding: const EdgeInsets.all(15.0),
                    child: Text(
                      'Member',
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 18.0,
                      ),
                    ),
                  ),
                ),
              ),
              SizedBox(
                height: 35.0,
              ),
              Padding(
                padding: const EdgeInsets.only(left: 28.0, right: 28.0),
                child: MaterialButton(
                  minWidth: double.infinity,
                  onPressed: () {
                    //trainer login page
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => TrainerLogin()),
                    );
                  },
                  color: Colors.black,
                  child: Padding(
                    padding: const EdgeInsets.all(15.0),
                    child: Text(
                      'Trainer',
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 18.0,
                      ),
                    ),
                  ),
                ),
              ),
            ],
          )),
        ),
      ),
    );
  }
}
