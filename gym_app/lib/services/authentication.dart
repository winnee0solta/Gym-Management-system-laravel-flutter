import 'package:gym_app/index.dart';
import 'package:http/http.dart' as http;

class Authentication {
  Future login(String username, String password) async {
    var response = await http.post(ApiHelper.loginurl, headers: {
      'Accept': 'application/json'
    }, body: {
      'username': username,
      'password': password,
    });

    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      if (data['status'] == 200) {
        SharedPreferences prefs = await SharedPreferences.getInstance();
        prefs.setInt('user_id', data['user']['id']);
        prefs.setString('type', data['user']['type']);
        prefs.setString('username', data['user']['username']);
 
      } 

      return data;
    } else {
      print('Request failed with status: ${response.reasonPhrase}.');
      throw Exception('Failed to login');
    }
  }

  Future register(String fullname, String username, String password) async {
    var response = await http.post(ApiHelper.registerurl, headers: {
      'Accept': 'application/json'
    }, body: {
      'fullname': fullname,
      'username': username,
      'password': password,
    });

    if (response.statusCode == 200) {
      print('Response body: ${response.body}');
      var data = json.decode(response.body);
      // if (data['status'] == 200) {
      //   SharedPreferences prefs = await SharedPreferences.getInstance();
      //   prefs.setInt('user_id', data['user']['id']);
      //   prefs.setString('type', data['user']['type']);
      //   prefs.setString('username', data['user']['username']);
      // }

      return data;
    } else {
      print('Request failed with status: ${response.reasonPhrase}.');
      throw Exception('Failed to login');
    }
  }

  Future<bool> check() async {
    bool isloggedin = false;
    SharedPreferences prefs = await SharedPreferences.getInstance();
    if (prefs.getInt('user_id') != null &&
        prefs.getString('type') != null &&
        prefs.getString('username') != null) {
      isloggedin = true;
    }
    return isloggedin;
  }

  Future<String> userType() async {
    String userType = '';
    SharedPreferences prefs = await SharedPreferences.getInstance();
    if (prefs.getInt('user_id') != null && prefs.getString('type') != null) {
      userType = prefs.getString('type');
    }
    return userType;
  }

  Future<String> userId() async {
    int id = 0;
    SharedPreferences prefs = await SharedPreferences.getInstance();
    if (prefs.getInt('user_id') != null && prefs.getString('type') != null) {
      id = prefs.getInt('user_id');
    }
    return id.toString();
  }

  Future logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.clear();
  }
}
