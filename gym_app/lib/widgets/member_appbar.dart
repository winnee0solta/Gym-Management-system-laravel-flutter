import 'package:gym_app/index.dart';

Widget memberAppBar(context) {
  return AppBar(
    title: Text('Gym Management System'),
    actions: [
      IconButton(
        icon: Icon(Icons.notifications),
        onPressed: () {
             //navigate to member  
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => NotificaitonsScreen()),
            );

        },
      )
    ],
  );
}
