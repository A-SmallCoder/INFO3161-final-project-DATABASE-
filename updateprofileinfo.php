<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Groups</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"
    />
    <style>
      #overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
      }
    </style>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
      <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="style.css" />
      <link rel ="stylesheet" type="text/css" href="userExperienceStyles.css"/>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"><a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="group.php">Group</a></li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <button class="dropbtn">Settings<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content"><a href="friend.php">Add Friends</a><a href="#">Create Group</a></div>
                </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div id="app">
      <div class="container-fluid">
        <div class="row bg-dark">
          <div class="col-lg-12 text-center text-light display-4 pt-2">
            <p></p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-3">
          <div class="col-lg-6">
            <h3 class="text-info">Profiles</h3>
          </div>
          <div class="col-lg-6">
            <button class="btn btn-info float-right" @click="showEditModal=true; selectUser(user);">
              Edit
            </button>
          </div>
        </div>
        <div class="alert alert-danger" v-if="errorMsg">
          {{ errorMsg }}
        </div>
        <div class="alert alert-success" v-if="successMsg">
          {{ successMsg }}
        </div>
        <!-- Display Records -->
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="text-center bg-info text-light">
                  <th>Username</th>
                  <th>Bio</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr class="text-center" v-for="group in profiles">
                  <td>{{group.username}}</td>
                  <td>{{group.Bio}}</td>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Add new User Model -->
      <div id="overlay" v-if="showEditModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="model-title">
                Edit Profile
              </h5>
              <button type="button" class="close" @click="showEditModal=false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-4">
              <form action="#" method="post">
                <div class="form-group">
                  <input
                    type="text"
                    name="groupid"
                    class="form-control form-control-lg"
                    v-model="currentUser.Bio"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    name="groupid"
                    placeholder="Enter Profile bio"
                    class="form-control form-control-lg"
                    v-model="currentUser.username"
                  />
                </div>
                
                </div>
                <div class="form-group">
                  <button
                    class="btn btn-info btn-block btn-lg"
                    @click="showEditModal=false; editProfile()"
                  >
                    Update
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script>
      var app = new Vue({
        el: "#app",
        data: {
          errorMsg: "",
          successMsg: "",
          showEditModal: false,
          profiles: [],
          newFriend: { username: "", Bio:"" }
          currentUser: {},
        },

        mounted: function () {
          //when this instance is created then all the methods called in this mounted function will execute automatically
          this.getAll();
        },

        methods: {
          // method for getting all users from db and displaying them into the main page
          getAll() {
            axios
              .get("http://localhost:8000/updateprofile.php?action=read")
              .then(function (response) {
                if (response.data.error) {
                  //check for any error
                  app.errorMsg = response.data.message; //assign error message
                } else {
                  app.profiles = response.data.profile;
                }
              });
          },
          editProfile() {
            var formData = app.toFormData(app.newGroup);
            axios
              .post(
                "http://localhost:8000/updateprofile.php?action=update",
                formData
              )
              .then(function (response) {
                app.newGroup = { groupname: ""};
                if (response.data.error) {
                  //check for any error
                  app.errorMsg = response.data.message; //assign error message
                } else {
                  app.successMsg = response.data.message;
                  app.getAllGroups();
                }
              });
          },
          toFormData(obj) {
            //get data and append all values in obj variable , by using obj we are assign all values in fd variable ...using this method in addUser Method
            var fd = new FormData();
            for (var i in obj) {
              fd.append(i, obj[i]);
            }
            return fd;
          },
          selectUser(user){
              app.currentUser = user;
          }
        },
      });
    </script>
    </body>
</html>