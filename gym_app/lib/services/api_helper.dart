class ApiHelper {
  static final String domain = "http://192.168.1.120:8000";
  static final String baseurl = domain + "/api";
  static final String loginurl = baseurl + "/login";
  static final String registerurl = baseurl + "/register";
  static final String trainerSchedule = baseurl + "/schedule/trainer";
  static final String trainerProfile = baseurl + "/trainer-data";
  static final String trainerMemberProfile = baseurl + "/member-data";
  static final String memberUpdateBodyStatus =
      baseurl + "/member-data/update-body-status";
  static final String memberUpdateNutritionPlans =
      baseurl + "/member-data/update-nutrition-plan";
  static final String memberUpdateWorkoutPlans =
      baseurl + "/member-data/update-workout-plan";
  static final String memberUpdateAttendance =
      baseurl + "/member-data/update-attendance";
  static final String trainerAttendance = baseurl + "/attendance/trainer";
  static final String trainerTodaysAttendance =
      baseurl + "/attendance/today/trainer";
  static final String notifications = baseurl + "/notifications";
  static final String memberProfile = baseurl + "/member-data/member";

  static final String memberAttendance = baseurl + "/attendance/member";
  static final String memberSchedule = baseurl + "/schedule/member";
  static final String memberPayment = baseurl + "/payment/member";

  static final String trash = baseurl + "/";
}
