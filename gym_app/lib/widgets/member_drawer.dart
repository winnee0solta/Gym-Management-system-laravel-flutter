import 'package:gym_app/index.dart';
import 'package:gym_app/screens/trainer/schedule.dart';

Widget memberAppDrawer(context) {
  return Drawer( 
    child: ListView(
      // Important: Remove any padding from the ListView.
      padding: EdgeInsets.zero,
      children: <Widget>[
        // DrawerHeader(
        //   child: Text('Drawer Header'),
        //   decoration: BoxDecoration(
        //     color: Colors.blue,
        //   ),
        // ),
        SizedBox(
          height: 50.0,
        ),
        ListTile(
          title: Text('Profile'),
          onTap: () { 
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => MemberHome()),
            );
          },
        ), 
        // ListTile(
        //   title: Text('Dashboard'),
        //   onTap: () {
        //     //navigate  
        //     Navigator.pushReplacement(
        //       context,
        //       MaterialPageRoute(builder: (context) => TrainerHomeScreen()),
        //     );
        //   },
        // ), 
        ListTile(
          title: Text('Schedule'),
          onTap: () {
            //navigate to  
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => MemberSchedule()),
            );
          },
        ),
        ListTile(
          title: Text('Workouts'),
          onTap: () {
            //navigate to  
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => MemberWorkout()),
            );
          },
        ),
        ListTile(
          title: Text('Nutrition'),
          onTap: () {
            //navigate to  
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => MemberNutrition()),
            );
          },
        ),
        ListTile(
          title: Text('Body Status'),
          onTap: () {
            //navigate to   
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => MemberBodystatus()),
            );
          },
        ),
        ListTile(
          title: Text('Attendance'),
          onTap: () {
            //navigate to 
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(
                  builder: (context) => MemberAttendance()),
            );
          },
        ),
        ListTile(
          title: Text('Payment'),
          onTap: () {
            //navigate to 
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(
                  builder: (context) => MemberPayment()),
            );
          },
        ),
        ListTile(
          title: Text('Logout'),
          onTap: () {
            //nlogout user
            Authentication().logout().then((value) {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => SplashScreen()),
              );
            });
          },
        ),
      ],
    ),
  );
}
