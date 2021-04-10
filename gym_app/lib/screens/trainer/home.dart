import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class TrainerHomeScreen extends StatefulWidget {
  TrainerHomeScreen({Key key}) : super(key: key);

  @override
  _TrainerHomeScreenState createState() => _TrainerHomeScreenState();
}

class _TrainerHomeScreenState extends State<TrainerHomeScreen> {
  bool isloading = true;

  var attendance;
  var trainer;
  var user;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: trainerAppBar(context),
      drawer: trainerAppDrawer(context),
      body: isloading
          ? LoadingLayout()
          : Container(
              child: Column(
              children: [
                attendanceStatus(),
                traierProfile(),
              ],
            )),
    );
  }

  Widget traierProfile() {
    return user != null && trainer != null
        ? Column(children: [
            //table
            Padding(
              padding: const EdgeInsets.all(18.0),
              child: Card(
                child: Padding(
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
                          child: Text(trainer['fullname'].toString(),
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
                          child: Text(trainer['phone'].toString(),
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
                          child: Text(trainer['address'].toString(),
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
                              trainer['shift_m'] == 1
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
                              trainer['shift_e'] == 1
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
              ),
            ),
          ])
        : SizedBox();
  }

  Widget attendanceStatus() {
    if (attendance == null) {
      return SizedBox();
    }

    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Attendance Status",
            style: TextStyle(
              fontSize: 18.0,
              color: Color(0xff0a0a0a),
            )),
        SizedBox(
          height: 10.0,
        ),
        Chip(
          label: Padding(
            padding: const EdgeInsets.all(8.0),
            child: Text(
              attendance.toString(),
              style: TextStyle(
                fontSize: 16.0,
                color: Color(0xff0a0a0a),
              ),
            ),
          ),
        ),
        SizedBox(
          height: 20.0,
        ),
      ],
    );
  }

  @override
  void initState() {
    super.initState();
    _populateData1();
    _populateData2();
  }

  Future<void> _populateData1() async {
    setState(() {
      isloading = true;
    });
    Authentication().userId().then((userId) async {
      var response = await http.get(
          ApiHelper.trainerProfile + "/" + userId.toString(),
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          // assignedmembers.clear();
          trainer = data['trainer'];
          user = data['user'];
          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }

  Future<void> _populateData2() async {
    setState(() {
      isloading = true;
    });
    Authentication().userId().then((userId) async {
      var response = await http.get(
          ApiHelper.trainerTodaysAttendance + "/" + userId,
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          attendance = data['attendance'];
          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }
}
