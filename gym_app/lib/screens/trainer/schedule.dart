import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class TrainerScheduleScreen extends StatefulWidget {
  TrainerScheduleScreen({Key key}) : super(key: key);

  @override
  _TrainerScheduleScreenState createState() => _TrainerScheduleScreenState();
}

class _TrainerScheduleScreenState extends State<TrainerScheduleScreen> {
  final GlobalKey<RefreshIndicatorState> _refreshIndicatorKey =
      new GlobalKey<RefreshIndicatorState>();

  bool isloading = true;
  List assignedmembers = [];
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
                itemCount: assignedmembers.length,
                itemBuilder: _buildItemsForListView,
              )),
    );
  }

  Widget _buildItemsForListView(BuildContext context, int index) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 5.0, horizontal: 15.0),
      child: GestureDetector(
        onTap: () {
          // Navigator.push(
          //   context,
          //   MaterialPageRoute(
          //     builder: (context) => SSingleCollege(
          //       collegeid: colleges[index].id,
          //     ),
          //   ),
          // );
        },
        child: Card(
          child: Padding(
            padding: const EdgeInsets.all(18.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.start,
              children: <Widget>[
                //name
                Text(
                  assignedmembers[index]['fullname'],
                  style: TextStyle(
                    fontSize: 20.0,
                    color: Color(0xff0a0a0a),
                  ),
                ),
                SizedBox(
                  height: 10.0,
                ),
                Text(
                  "${assignedmembers[index]['address'] + ", "+ assignedmembers[index]['phone']}"
                  ,
                  style: TextStyle(
                    fontSize: 16.0,
                    color: Color(0xff0a0a0a),
                  ),
                ), 
                 SizedBox(
                  height: 5.0,
                ),
                //Shfts
                Row(
                  children: [
                    //morning shift
                    assignedmembers[index]['shift_m'] == 1
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
                        SizedBox(width: 5.0,),
                    //evening shift
                    assignedmembers[index]['shift_e'] == 1
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
      var response = await http.get(ApiHelper.trainerSchedule + "/" + userId,
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          assignedmembers.clear();
          assignedmembers = data['datas'];
          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }
}
