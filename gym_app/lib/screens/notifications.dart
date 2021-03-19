import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class NotificaitonsScreen extends StatefulWidget {
  NotificaitonsScreen({Key key}) : super(key: key);

  @override
  _NotificaitonsScreenState createState() => _NotificaitonsScreenState();
}

class _NotificaitonsScreenState extends State<NotificaitonsScreen> {
  bool isloading = true;
  List notifications = [];
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Notificaitons'),
      ),
      body: isloading
          ? LoadingLayout()
          : Container(
              height: MediaQuery.of(context).size.height,
              color: Color(0xfff2f3f5),
              child: ListView.builder(
                scrollDirection: Axis.vertical,
                itemCount: notifications.length,
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
            padding: const EdgeInsets.all(8.0),
            child: ListTile(
              title:  Text(
                  notifications[index]['created_at'],
                  style: TextStyle(
                    fontSize: 16.0,
                    color: Color(0xff0a0a0a),
                  ),
                ),
                subtitle:  Padding(
                  padding: const EdgeInsets.only(top:10.0),
                  child: Text(
                    notifications[index]['notice'],
                    style: TextStyle(
                      fontSize: 20.0,
                      color: Color(0xff0a0a0a),
                    ),
                  ),
                ),
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
      var response = await http.get(ApiHelper.notifications + "/" + userId,
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          notifications.clear();
          notifications = data['notifications'];
          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }
}
