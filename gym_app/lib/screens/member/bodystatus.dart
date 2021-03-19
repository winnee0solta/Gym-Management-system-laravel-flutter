import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class MemberBodystatus extends StatefulWidget {
  MemberBodystatus({Key key}) : super(key: key);

  @override
  _MemberBodystatusState createState() => _MemberBodystatusState();
}

class _MemberBodystatusState extends State<MemberBodystatus> {
  bool isloading = true;

  final Color fieldColor = Color(0xffedeef3);
  final Color brandColor = Color(0xffb0a999);

  //controllers for body status
  final weightController = TextEditingController();
  final heightController = TextEditingController();
  final chestController = TextEditingController();
  final stomachController = TextEditingController();
  final bicepsController = TextEditingController();
  final thighsController = TextEditingController();

  @override
  void dispose() {
    //controllers for body status
    weightController.dispose();
    heightController.dispose();
    chestController.dispose();
    stomachController.dispose();
    bicepsController.dispose();
    thighsController.dispose();

    super.dispose();
  }

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
                  Text("Body Status",
                      style: TextStyle(
                        fontSize: 20.0,
                        color: Color(0xff0a0a0a),
                      )),
                  memberBodyStatus(),
                ],
              )),
            ),
    );
  }

  Widget memberBodyStatus() {
    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        //Weight
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: weightController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Weight',
                labelText: 'Weight',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
        //height
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: heightController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Height',
                labelText: 'Height',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
        //chest
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: chestController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Chest',
                labelText: 'Chest',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
        //stomach
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: stomachController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Stomach',
                labelText: 'Stomach',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
        //biceps
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: bicepsController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Biceps',
                labelText: 'Biceps',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
        //thighs
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              enabled: false,
              controller: thighsController,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Thighs',
                labelText: 'Thighs',
                enabledBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
                focusedBorder: OutlineInputBorder(
                    borderSide: BorderSide(color: Colors.transparent),
                    borderRadius: BorderRadius.circular(20.0)),
              ),
            )),
        SizedBox(
          height: 30.0,
        ),
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
          ApiHelper.memberProfile + "/" + userId.toString(),
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          //bodystatus
          weightController.value =
              TextEditingValue(text: data['bodystatus']['weight']);
          heightController.value =
              TextEditingValue(text: data['bodystatus']['height']);
          chestController.value =
              TextEditingValue(text: data['bodystatus']['chest']);
          stomachController.value =
              TextEditingValue(text: data['bodystatus']['stomach']);
          bicepsController.value =
              TextEditingValue(text: data['bodystatus']['biceps']);
          thighsController.value =
              TextEditingValue(text: data['bodystatus']['thighs']);

          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get data');
      }
    });
  }
}
