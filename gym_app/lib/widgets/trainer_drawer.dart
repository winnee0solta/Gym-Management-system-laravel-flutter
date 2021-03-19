import 'package:gym_app/index.dart';
import 'package:gym_app/screens/trainer/schedule.dart';

Widget trainerAppDrawer(context) {
  return Drawer(
    // Add a ListView to the drawer. This ensures the user can scroll
    // through the options in the drawer if there isn't enough vertical
    // space to fit everything.
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
          title: Text('Dashboard'),
          onTap: () {
            //navigate to trainer home
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => TrainerHomeScreen()),
            );
          },
        ),
        ListTile(
          title: Text('Schedule'),
          onTap: () {
            //navigate to  trainer Schedule
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => TrainerScheduleScreen()),
            );
          },
        ),
        ListTile(
          title: Text('Member'),
          onTap: () {
            //navigate to  trainer Member
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => TrainerMemberScreen()),
            );
          },
        ),
        ListTile(
          title: Text('Attendance'),
          onTap: () {
            //navigate to  trainer Attendance
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(
                  builder: (context) => TrainerAttendanceScreen()),
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
