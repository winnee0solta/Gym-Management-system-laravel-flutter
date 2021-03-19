import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class MemberSchedule extends StatefulWidget {
  MemberSchedule({Key key}) : super(key: key);

  @override
  _MemberScheduleState createState() => _MemberScheduleState();
}

class _MemberScheduleState extends State<MemberSchedule> {
  bool isloading = true;

  var member;
  var morningschedules;
  var eveningschedules;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: memberAppBar(context),
      drawer: memberAppDrawer(context),
      body: isloading
          ? LoadingLayout()
          : SingleChildScrollView(
              child: Container(
                  child: Column(
                children: [
                  SizedBox(
                    height: 20.0,
                  ),
                 member != null && member['shift_m'] == 1 ? morningSchedule() : SizedBox(),
                 member != null && member['shift_e'] == 1 ? eveningSchedule() : SizedBox(),
                ],
              )),
            ),
    );
  }

  Widget morningSchedule() {
    List<Widget> letsbuild = List<Widget>();

    //sunday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Sunday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['sunday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));

    //monday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Monday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['monday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //tuesday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Tuesday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['tuesday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //wednesday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Wednesday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['wednesday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //thursday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Thursday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['thursday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //friday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Friday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['friday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //saturday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Saturday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(morningschedules['saturday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));

    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Morning Schedule",
            style: TextStyle(
              fontSize: 20.0,
              color: Color(0xff0a0a0a),
            )),
        Column(children: letsbuild)
      ],
    );
  }
  Widget eveningSchedule() {
    List<Widget> letsbuild = List<Widget>();

    //sunday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Sunday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['sunday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));

    //monday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Monday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['monday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //tuesday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Tuesday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['tuesday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //wednesday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Wednesday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['wednesday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //thursday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Thursday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['thursday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //friday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Friday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['friday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));
    //saturday
    letsbuild.add(Padding(
      padding: const EdgeInsets.all(8.0),
      child: Card(
        child: ListTile(
          title: Text("Saturday",
              style: TextStyle(
                fontSize: 18.0,
                color: Color(0xff0a0a0a),
              )),
          subtitle: Padding(
            padding: const EdgeInsets.only(top: 9.0),
            child: Text(eveningschedules['saturday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));

    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Evening Schedule",
            style: TextStyle(
              fontSize: 20.0,
              color: Color(0xff0a0a0a),
            )),
        Column(children: letsbuild)
      ],
    );
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
          ApiHelper.memberSchedule + "/" + userId.toString(),
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          // assignedmembers.clear();
          member = data['member'];
          // user = data['user'];
          morningschedules = data['morning_schedules'];
          eveningschedules = data['evening_schedules'];

          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get data');
      }
    });
  }
}
