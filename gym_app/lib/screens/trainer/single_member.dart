import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class TrainerSingleMember extends StatefulWidget {
  // collegeid
  final String memberid;
  TrainerSingleMember({Key key, @required this.memberid}) : super(key: key);

  @override
  _TrainerSingleMemberState createState() => _TrainerSingleMemberState();
}

class _TrainerSingleMemberState extends State<TrainerSingleMember> {
  final GlobalKey<RefreshIndicatorState> _refreshIndicatorKey =
      new GlobalKey<RefreshIndicatorState>();
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  final Color fieldColor = Color(0xffedeef3);
  final Color brandColor = Color(0xffb0a999);

  bool isloading = true;
  List assignedmembers = [];

  var member;
  var user;
  var attendance;

  //controllers for body status
  final weightController = TextEditingController();
  final heightController = TextEditingController();
  final chestController = TextEditingController();
  final stomachController = TextEditingController();
  final bicepsController = TextEditingController();
  final thighsController = TextEditingController();
  //controllers for Nutrition Plans
  final npFSC = TextEditingController();
  final npFMC = TextEditingController();
  final npFTC = TextEditingController();
  final npFWC = TextEditingController();
  final npFThC = TextEditingController();
  final npFFC = TextEditingController();
  final npFSaC = TextEditingController();
  //controllers for Workout Plans
  final wpFSC = TextEditingController();
  final wpFMC = TextEditingController();
  final wpFTC = TextEditingController();
  final wpFWC = TextEditingController();
  final wpFThC = TextEditingController();
  final wpFFC = TextEditingController();
  final wpFSaC = TextEditingController();

  @override
  void dispose() {
    //controllers for body status
    weightController.dispose();
    heightController.dispose();
    chestController.dispose();
    stomachController.dispose();
    bicepsController.dispose();
    thighsController.dispose();
    //controllers for Nutrition Plans
    npFSC.dispose();
    npFMC.dispose();
    npFTC.dispose();
    npFWC.dispose();
    npFThC.dispose();
    npFFC.dispose();
    npFSaC.dispose();
    //controllers for Workout Plans
    wpFSC.dispose();
    wpFMC.dispose();
    wpFTC.dispose();
    wpFWC.dispose();
    wpFThC.dispose();
    wpFFC.dispose();
    wpFSaC.dispose();

    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(),
      body: isloading
          ? LoadingLayout()
          : SingleChildScrollView(
              child: Container(
                child: Column(
                  children: [
                    memberProfile(),
                    memberTodaysAttendance(),
                    memberBodyStatus(),
                    memberNutritionPlan(),
                    memberWorkoutPlan(),
                    SizedBox(
                      height: 30.0,
                    )
                  ],
                ),
              ),
            ),
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

  Widget memberBodyStatus() {
    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Body Status",
            style: TextStyle(
              fontSize: 18.0,
              color: Color(0xff0a0a0a),
            )),
        SizedBox(
          height: 10.0,
        ),
        //Weight
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
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
        //button
        MaterialButton(
          minWidth: 300,
          onPressed: () {
            if (!isloading) _updateBodyStatus();
          },
          color: Theme.of(context).primaryColor,
          child: Padding(
            padding: const EdgeInsets.all(15.0),
            child: Text(
              !isloading ? 'Update Body Status' : 'Please Wait..',
              style: TextStyle(
                color: Colors.white,
                fontSize: 18.0,
              ),
            ),
          ),
        ),
        SizedBox(
          height: 30.0,
        ),
      ],
    );
  }

  Widget memberNutritionPlan() {
    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Nutrition Plans",
            style: TextStyle(
              fontSize: 18.0,
              color: Color(0xff0a0a0a),
            )),
        SizedBox(
          height: 30.0,
        ),
        //Sunday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFSC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Sunday',
                labelText: 'Sunday',
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
        //monday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFMC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Monday',
                labelText: 'Monday',
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
        //tuesday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFTC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Tuesday',
                labelText: 'Tuesday',
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
        //wednesday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFWC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Wednesday',
                labelText: 'Wednesday',
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
        //thursday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFThC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Thursday',
                labelText: 'Thursday',
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
        //friday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFFC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Friday',
                labelText: 'Friday',
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
        //saturday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: npFSaC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Saturday',
                labelText: 'Saturday',
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
        //button
        MaterialButton(
          minWidth: 300,
          onPressed: () {
            if (!isloading) _updateNutritionPlans();
          },
          color: Theme.of(context).primaryColor,
          child: Padding(
            padding: const EdgeInsets.all(15.0),
            child: Text(
              !isloading ? 'Update Nutrition Plans' : 'Please Wait..',
              style: TextStyle(
                color: Colors.white,
                fontSize: 18.0,
              ),
            ),
          ),
        ),
        SizedBox(
          height: 30.0,
        ),
      ],
    );
  }

  Widget memberWorkoutPlan() {
    return Column(
      children: [
        SizedBox(
          height: 20.0,
        ),
        Text("Workout Plans",
            style: TextStyle(
              fontSize: 18.0,
              color: Color(0xff0a0a0a),
            )),
        SizedBox(
          height: 30.0,
        ),
        //Sunday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              keyboardType: TextInputType.multiline,
              minLines: 5,
              maxLines: 5,
              controller: wpFSC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Sunday',
                labelText: 'Sunday',
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
        //monday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFMC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Monday',
                labelText: 'Monday',
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
        //tuesday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFTC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Tuesday',
                labelText: 'Tuesday',
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
        //wednesday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFWC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Wednesday',
                labelText: 'Wednesday',
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
        //thursday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFThC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Thursday',
                labelText: 'Thursday',
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
        //friday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFFC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Friday',
                labelText: 'Friday',
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
        //saturday
        Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40.0),
            child: TextField(
              minLines: 5,
              maxLines: 5,
              controller: wpFSaC,
              decoration: InputDecoration(
                filled: true,
                fillColor: fieldColor,
                hintText: 'Saturday',
                labelText: 'Saturday',
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
        //button
        MaterialButton(
          minWidth: 300,
          onPressed: () {
            if (!isloading) _updateWorkoutPlans();
          },
          color: Theme.of(context).primaryColor,
          child: Padding(
            padding: const EdgeInsets.all(15.0),
            child: Text(
              !isloading ? 'Update Workout Plans' : 'Please Wait..',
              style: TextStyle(
                color: Colors.white,
                fontSize: 18.0,
              ),
            ),
          ),
        ),
        SizedBox(
          height: 30.0,
        ),
      ],
    );
  }

  Widget memberTodaysAttendance() {
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
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            MaterialButton(
              // minWidth: 300,
              onPressed: () {
                _updateAttendance('PRESENT');
              },
              color: Colors.green,
              child: Padding(
                padding: const EdgeInsets.all(15.0),
                child: Text(
                  'Mark Present',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18.0,
                  ),
                ),
              ),
            ),
            SizedBox(
              width: 20.0,
            ),
            MaterialButton(
              // minWidth: 300,
              onPressed: () {
                _updateAttendance('ABSENT');
              },
              color: Colors.red,
              child: Padding(
                padding: const EdgeInsets.all(15.0),
                child: Text(
                  'Mark Absent',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18.0,
                  ),
                ),
              ),
            ),
          ],
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
    setState(() {
      isloading = true;
    });
    Authentication().userId().then((userId) async {
      var response = await http.get(
          ApiHelper.trainerMemberProfile + "/" + widget.memberid.toString(),
          headers: {'Accept': 'application/json'});
      if (response.statusCode == 200) {
        // print('Response body: ${response.body}');
        var data = json.decode(response.body);

        setState(() {
          // assignedmembers.clear();
          member = data['member'];
          user = data['user'];

          //bodystatus
          weightController.value =
              TextEditingValue(text: data['bodystatus']['weight'].toString());
          heightController.value =
              TextEditingValue(text: data['bodystatus']['height'].toString());
          chestController.value =
              TextEditingValue(text: data['bodystatus']['chest'].toString());
          stomachController.value =
              TextEditingValue(text: data['bodystatus']['stomach'].toString());
          bicepsController.value =
              TextEditingValue(text: data['bodystatus']['biceps'].toString());
          thighsController.value =
              TextEditingValue(text: data['bodystatus']['thighs'].toString());
          //Nutrition
          npFSC.value = TextEditingValue(
              text: data['nutrition_plans']['sunday'].toString());
          npFMC.value = TextEditingValue(
              text: data['nutrition_plans']['monday'].toString());
          npFTC.value = TextEditingValue(
              text: data['nutrition_plans']['tuesday'].toString());
          npFWC.value = TextEditingValue(
              text: data['nutrition_plans']['wednesday'].toString());
          npFThC.value = TextEditingValue(
              text: data['nutrition_plans']['thursday'].toString());
          npFFC.value = TextEditingValue(
              text: data['nutrition_plans']['friday'].toString());
          npFSaC.value = TextEditingValue(
              text: data['nutrition_plans']['saturday'].toString());
          //Workout
          wpFSC.value = TextEditingValue(
              text: data['workout_plans']['sunday'].toString());
          wpFMC.value = TextEditingValue(
              text: data['workout_plans']['monday'].toString());
          wpFTC.value = TextEditingValue(
              text: data['workout_plans']['tuesday'].toString());
          wpFWC.value = TextEditingValue(
              text: data['workout_plans']['wednesday'].toString());
          wpFThC.value = TextEditingValue(
              text: data['workout_plans']['thursday'].toString());
          wpFFC.value = TextEditingValue(
              text: data['workout_plans']['friday'].toString());
          wpFSaC.value = TextEditingValue(
              text: data['workout_plans']['saturday'].toString());

          //attendance

          attendance = data['attendance'];

          isloading = false;
        });
      } else {
        print('Request failed with status: ${response.reasonPhrase}.');
        throw Exception('Failed to get colleges');
      }
    });
  }

  Future<void> _updateBodyStatus() async {
    var weight = weightController.text;
    var height = heightController.text;
    var chest = chestController.text;
    var stomach = stomachController.text;
    var biceps = bicepsController.text;
    var thighs = thighsController.text;

    if (weight == '' ||
        height == '' ||
        chest == '' ||
        stomach == '' ||
        biceps == '' ||
        thighs == '') {
      //show snackbar
      _scaffoldKey.currentState
          .showSnackBar(SnackBar(content: Text('Empty Fields!')));
      return;
    }

    setState(() {
      isloading = true;
    });

    var response = await http.post(ApiHelper.memberUpdateBodyStatus, body: {
      'member_id': widget.memberid.toString(),
      'weight': weight.toString(),
      'height': height.toString(),
      'chest': chest.toString(),
      'stomach': stomach.toString(),
      'biceps': biceps.toString(),
      'thighs': thighs.toString(),
    }, headers: {
      'Accept': 'application/json'
    });
    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      if (data['status'] == 200) {
        _populateData();
      }
    } else {
      print('Request failed with : ${response.reasonPhrase}.');
      throw Exception('Failed ');
    }
  }

  Future<void> _updateNutritionPlans() async {
    var sunday = npFSC.text;
    var monday = npFMC.text;
    var tuesday = npFTC.text;
    var wednesday = npFWC.text;
    var thursday = npFThC.text;
    var friday = npFFC.text;
    var saturday = npFSaC.text;

    if (sunday == '' ||
        monday == '' ||
        tuesday == '' ||
        wednesday == '' ||
        thursday == '' ||
        friday == '' ||
        saturday == '') {
      //show snackbar
      _scaffoldKey.currentState
          .showSnackBar(SnackBar(content: Text('Empty Fields!')));
      return;
    }

    setState(() {
      isloading = true;
    });

    var response = await http.post(ApiHelper.memberUpdateNutritionPlans, body: {
      'member_id': widget.memberid.toString(),
      'sunday': sunday.toString(),
      'monday': monday.toString(),
      'tuesday': tuesday.toString(),
      'wednesday': wednesday.toString(),
      'thursday': thursday.toString(),
      'friday': friday.toString(),
      'saturday': saturday.toString(),
    }, headers: {
      'Accept': 'application/json'
    });
    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      if (data['status'] == 200) {
        _populateData();
      }
    } else {
      print('Request failed with : ${response.reasonPhrase}.');
      throw Exception('Failed ');
    }
  }

  Future<void> _updateWorkoutPlans() async {
    var sunday = wpFSC.text;
    var monday = wpFMC.text;
    var tuesday = wpFTC.text;
    var wednesday = wpFWC.text;
    var thursday = wpFThC.text;
    var friday = wpFFC.text;
    var saturday = wpFSaC.text;

    if (sunday == '' ||
        monday == '' ||
        tuesday == '' ||
        wednesday == '' ||
        thursday == '' ||
        friday == '' ||
        saturday == '') {
      //show snackbar
      _scaffoldKey.currentState
          .showSnackBar(SnackBar(content: Text('Empty Fields!')));
      return;
    }

    setState(() {
      isloading = true;
    });

    var response = await http.post(ApiHelper.memberUpdateWorkoutPlans, body: {
      'member_id': widget.memberid.toString(),
      'sunday': sunday.toString(),
      'monday': monday.toString(),
      'tuesday': tuesday.toString(),
      'wednesday': wednesday.toString(),
      'thursday': thursday.toString(),
      'friday': friday.toString(),
      'saturday': saturday.toString(),
    }, headers: {
      'Accept': 'application/json'
    });
    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      if (data['status'] == 200) {
        _populateData();
      }
    } else {
      print('Request failed with : ${response.reasonPhrase}.');
      throw Exception('Failed ');
    }
  }

  Future<void> _updateAttendance(status) async {
    print(status);
    setState(() {
      isloading = true;
    });

    var response = await http.post(ApiHelper.memberUpdateAttendance, body: {
      'member_id': widget.memberid.toString(),
      'status': status.toString(),
    }, headers: {
      'Accept': 'application/json'
    });
    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      if (data['status'] == 200) {
        _populateData();
      }
    } else {
      print('Request failed with : ${response.reasonPhrase}.');
      throw Exception('Failed ');
    }
  }
}
