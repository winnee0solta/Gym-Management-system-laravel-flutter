import 'package:gym_app/index.dart';

import 'package:http/http.dart' as http;

class TrainerAttendanceScreen extends StatefulWidget {
  TrainerAttendanceScreen({Key key}) : super(key: key);

  @override
  _TrainerAttendanceScreenState createState() =>
      _TrainerAttendanceScreenState();
}

class _TrainerAttendanceScreenState extends State<TrainerAttendanceScreen> {
  bool isloading = true;
  List attendances = [];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: trainerAppBar(context),
      drawer: trainerAppDrawer(context),
      body: isloading
          ? LoadingLayout()
          : Container(
              height: MediaQuery.of(context).size.height,
              color: Color(0xfff2f3f5),
              child: ListView.builder(
                scrollDirection: Axis.vertical,
                itemCount: attendances.length,
                itemBuilder: _buildItemsForListView,
              )),
    );
  }

  Widget _buildItemsForListView(BuildContext context, int index) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 5.0, horizontal: 15.0),
      child: GestureDetector(
        onTap: () {},
        child: Card(
          child: Padding(
            padding: const EdgeInsets.all(18.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.start,
              children: <Widget>[
                Text(
                  attendances[index]['date'],
                  style: TextStyle(
                    fontSize: 20.0,
                    color: Color(0xff0a0a0a),
                  ),
                ),
                SizedBox(
                  height: 13.0,
                ),
                Chip(
                 backgroundColor: attendances[index]['status'] == 'PRESENT'?  Colors.green:Colors.red,
                  label: Padding(
                    padding: const EdgeInsets.symmetric(vertical: 9.0,horizontal: 12.0),
                    child: Text(
                      attendances[index]['status'],
                      style: TextStyle(
                        fontSize: 16.0,
                        color: Colors.white,
                      ),
                    ),
                  ),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }

  @override
  void initState() {
    super.initState();
    _populateData();
  }

  Future<void> _populateData() async {
    setState(() {
      isloading = true;
    });
    Authentication().userId().then((userId) async {
      var response = await http.get(ApiHelper.trainerAttendance + "/" + userId,
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          attendances.clear();
          attendances = data['trainer_attendances'];
          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }
}
