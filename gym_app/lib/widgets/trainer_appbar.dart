import 'package:gym_app/index.dart';

Widget trainerAppBar(context) {
  return AppBar(
    title: Text('Gym Management System'),
    actions: [
      IconButton(
        icon: Icon(Icons.notifications),
        onPressed: () {
             //navigate to trainer home
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => NotificaitonsScreen()),
            );

        },
      )
    ],
  );
}
