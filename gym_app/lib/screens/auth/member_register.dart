import 'package:gym_app/index.dart';


class MemberRegisterScreen extends StatefulWidget {
  MemberRegisterScreen({Key key}) : super(key: key);

  @override
  _MemberRegisterScreenState createState() => _MemberRegisterScreenState();
}

class _MemberRegisterScreenState extends State<MemberRegisterScreen> {

  
    //variables
  bool logingin = false;
  final Color fieldColor = Color(0xffedeef3);
  final Color brandColor = Color(0xffb0a999);
  final usernameController = TextEditingController();
  final passwordController = TextEditingController();
  final fullnameController = TextEditingController();
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  
  @override
  void dispose() {
    usernameController.dispose();
    passwordController.dispose();
    fullnameController.dispose();
    super.dispose();
  }


  @override
  Widget build(BuildContext context) {
       return Scaffold(
      key: _scaffoldKey,
      body: SingleChildScrollView(
        child: Container(
          height: MediaQuery.of(context).size.height,
          width: MediaQuery.of(context).size.width,
          color: Colors.white,
          child: Column(
            mainAxisSize: MainAxisSize.max,
            children: <Widget>[
              SizedBox(
                height: 80.0,
              ), 
              SizedBox(
                height: 100.0,
              ),
              //welcome back
              Text(
                'Member Register',
                style: TextStyle(
                  fontSize: 30.0,
                  color: Colors.black,
                ),
              ),
              SizedBox(
                height: 30.0,
              ),

              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 40.0),
                child: Column(
                  children: <Widget>[
                    //Fullname
                    TextField(
                      controller: fullnameController,
                      decoration: InputDecoration(
                        filled: true,
                        fillColor: fieldColor,
                        hintText: 'Fullname',
                        enabledBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                        focusedBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                      ),
                    ),
                    SizedBox(
                      height: 30.0,
                    ),
                    //username
                    TextField(
                      controller: usernameController,
                      decoration: InputDecoration(
                        filled: true,
                        fillColor: fieldColor,
                        hintText: 'Username',
                        enabledBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                        focusedBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                      ),
                    ),
                    SizedBox(
                      height: 30.0,
                    ),

                    //password
                    TextField(
                      controller: passwordController,
                      obscureText: true,
                      decoration: InputDecoration(
                        filled: true,
                        fillColor: fieldColor,
                        hintText: 'Password',
                        enabledBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                        focusedBorder: OutlineInputBorder(
                            borderSide: BorderSide(color: Colors.transparent),
                            borderRadius: BorderRadius.circular(20.0)),
                      ),
                    ),
                    SizedBox(
                      height: 45.0,
                    ),

                    //button
                    MaterialButton(
                      minWidth: double.infinity,
                      onPressed: () {
                        if (!logingin) _registerUser();
                      },
                      color: Theme.of(context).primaryColor,
                      child: Padding(
                        padding: const EdgeInsets.all(15.0),
                        child: Text(
                          !logingin ? 'Register' : 'Please Wait..',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 18.0,
                          ),
                        ),
                      ),
                    ),
                    
                  ],
                ),
              ),
                SizedBox(
                height: 40.0,
              ),

              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => MemberLoginScreen()),
                  );
                },
                child: Text(
                  "Already have account ? Login",
                  style: TextStyle(
                    fontSize: 18.0,
                    color: Colors.blueGrey,
                  ),
                ),
              ),
 
            ],
          ),
        ),
      ),
    );
  }

  // _registerUser

   void _registerUser() {
    var fullname = fullnameController.text;
    var username = usernameController.text;
    var password = passwordController.text;
    if (fullname == '' ||username == '' || password == '') {
      //show snackbar
      _scaffoldKey.currentState
          .showSnackBar(SnackBar(content: Text('Empty Fields!')));
      return;
    }
    Authentication().register(fullname,username, password).then((res) async {
      if (res['status'] == 200) {
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => MemberLoginScreen()),
        );
      } else {
        _scaffoldKey.currentState
            .showSnackBar(SnackBar(content: Text(res['message'].toString())));
      }
    });
  }


}