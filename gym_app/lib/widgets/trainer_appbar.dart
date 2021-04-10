import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

Widget trainerAppBar(context) {
  return AppBar(title: Text('Gym Management System'), actions: <Widget>[
    // Using Stack to show Notification Badge
    TrainerAppBarInner(),
  ]);
}

class TrainerAppBarInner extends StatefulWidget {
  TrainerAppBarInner({Key key}) : super(key: key);

  @override
  _TrainerAppBarInnerState createState() => _TrainerAppBarInnerState();
}

class _TrainerAppBarInnerState extends State<TrainerAppBarInner> {
  int noticecount = 0;
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        new IconButton(
            icon: Icon(Icons.notifications),
            onPressed: () {
              // navigate to trainer home
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => NotificaitonsScreen()),
              );
            }),
        Positioned(
          right: 11,
          top: 11,
          child: new Container(
            padding: EdgeInsets.all(2),
            decoration: new BoxDecoration(
              color: Colors.blue,
              borderRadius: BorderRadius.circular(6),
            ),
            constraints: BoxConstraints(
              minWidth: 14,
              minHeight: 14,
            ),
            child: Text(
              '$noticecount',
              style: TextStyle(
                color: Colors.white,
                fontSize: 8,
              ),
              textAlign: TextAlign.center,
            ),
          ),
        )
      ],
    );
  }

  @override
  void initState() {
    super.initState();
    _populateNotificationData();
  }

  //count notifications for trainer
  Future<void> _populateNotificationData() async {
    Authentication().userId().then((userId) async {
      var response = await http.get(
          ApiHelper.notifications + "/" + userId + "/count",
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          noticecount = data['noticecount'];
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }
}
