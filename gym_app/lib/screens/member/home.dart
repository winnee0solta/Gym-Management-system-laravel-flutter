//profile
import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class MemberHome extends StatefulWidget {
  MemberHome({Key key}) : super(key: key);

  @override
  _MemberHomeState createState() => _MemberHomeState();
}

class _MemberHomeState extends State<MemberHome> {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  bool isloading = true;

  var member;
  var user;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: memberAppBar(context),
      drawer: memberAppDrawer(context),
      body: isloading
          ? LoadingLayout()
          : Container(
              child: Column(
              children: [
                memberProfile(),
              ],
            )),
    );
  }

  Widget memberProfile() {
    if (member != null && user != null) {
      return Padding(
        padding: const EdgeInsets.all(18.0),
        child: Card(
          child: Column(
            children: [
              //image
              member['image'] != 'no'
                  ? Image.network(ApiHelper.domain+"/images/pics/"+member['image'],height: 150.0,)
                  : SizedBox(),

                  SizedBox(height: 15.0,),
              //table
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: Table(
                  children: [
                    //username
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Username",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(user['username'].toString(),
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                    ]),

                    //FUllname
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Fullname",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(member['fullname'].toString(),
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                    ]),
                    //phone
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Phone",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(member['phone'].toString(),
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                    ]),
                    //address
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Address",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(member['address'].toString(),
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                    ]),
                      //expiration_date
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Expiration Date",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(member['expiration_date'].toString(),
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                    ]),
                    //shifts
                    TableRow(children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text("Shifts",
                            style: TextStyle(
                              fontSize: 18.0,
                              color: Color(0xff0a0a0a),
                            )),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Row(
                          children: [
                            //morning shift
                            member['shift_m'] == 1
                                ? Chip(
                                    label: Text(
                                      'Morning',
                                      style: TextStyle(
                                        fontSize: 16.0,
                                        color: Color(0xff0a0a0a),
                                      ),
                                    ),
                                  )
                                : SizedBox(),
                            SizedBox(
                              width: 5.0,
                            ),
                            //evening shift
                            member['shift_e'] == 1
                                ? Chip(
                                    label: Text(
                                      'Evening',
                                      style: TextStyle(
                                        fontSize: 16.0,
                                        color: Color(0xff0a0a0a),
                                      ),
                                    ),
                                  )
                                : SizedBox(),
                          ],
                        ),
                      ),
                    ]),

                   

                  ],
                ),
              ),
            ],
          ),
        ),
      );
    } else {
      return Text('');
    }
  }

  @override
  void initState() {
    super.initState();
    _populateData();
  }

  Future<void> _populateData() async {
    Authentication().userId().then((userId) async {
      print(userId);
      var response = await http.get(
          ApiHelper.memberProfile + "/" + userId.toString(),
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          // assignedmembers.clear();
          member = data['member'];
          user = data['user'];

          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get data');
      }
    });
  }
}
