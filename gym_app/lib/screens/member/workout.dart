import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class MemberWorkout extends StatefulWidget {
  MemberWorkout({Key key}) : super(key: key);

  @override
  _MemberWorkoutState createState() => _MemberWorkoutState();
}

class _MemberWorkoutState extends State<MemberWorkout> {
  bool isloading = true;

  var workout;

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
                  Text("Workout Plans",
                      style: TextStyle(
                        fontSize: 20.0,
                        color: Color(0xff0a0a0a),
                      )),
                  workouts(),
                ],
              )),
            ),
    );
  }

  Widget workouts() {
    List<Widget> letsbuild = List<Widget>();

    print(workout);

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
            child: Text(workout['sunday'],
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
            child: Text(workout['monday'],
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
            child: Text(workout['tuesday'],
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
            child: Text(workout['wednesday'],
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
            child: Text(workout['thursday'],
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
            child: Text(workout['friday'],
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
            child: Text(workout['saturday'],
                style: TextStyle(
                  fontSize: 16.0,
                  color: Color(0xff0a0a0a),
                )),
          ),
        ),
      ),
    ));

    return Column(children: letsbuild);
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
          workout = data['workout_plans'];

          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get data');
      }
    });
  }
}
