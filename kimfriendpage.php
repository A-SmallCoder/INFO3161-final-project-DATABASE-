<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Application Vue Js PHP anD mysqli</title>
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
  </head>
  <body>
    <div id="app">
      <div class="container-fluid">
        <div class="row bg-dark">
          <div class="col-lg-12 text-center text-light display-4 pt-2">
            <p>Application Vue Js PHP anD mysqli</p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-3">
          <div class="col-lg-6">
            <h3 class="text-info">Registered Users</h3>
          </div>
          <div class="col-lg-6">
            <button class="btn btn-info float-right" @click="showAddModal=true">
              Add new user
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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center">
                  <td>1</td>
                  <td>Wolfmania</td>
                  <td>wolfmania@gmail.com</td>
                  <td>2404203i1</td>
                  <td><a href="#" class="text-success">Edit</a></td>
                  <td><a href="#" class="text-success">Delete</a></td>
                </tr>
                <tr class="text-center">
                  <td>1</td>
                  <td>Wolfmania</td>
                  <td>wolfmania@gmail.com</td>
                  <td>2404203i1</td>
                  <td><a href="#" class="text-success">Edit</a></td>
                  <td><a href="#" class="text-success">Delete</a></td>
                </tr>
                <tr class="text-center">
                  <td>1</td>
                  <td>Wolfmania</td>
                  <td>wolfmania@gmail.com</td>
                  <td>2404203i1</td>
                  <td><a href="#" class="text-success">Edit</a></td>
                  <td><a href="#" class="text-success">Delete</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Add new User Model -->
      <div id="overlay" v-if="showAddModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="model-title">
                Add New User
              </h5>
              <button type="button" class="close" @click="showAddModal=false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-4">
              <form action="#" method="post">
                <div class="form-group">
                  <input
                    type="text"
                    name="name"
                    placeholder="Name"
                    class="form-control form-control-lg"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    name="email"
                    placeholder="Email"
                    class="form-control form-control-lg"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    name="phone"
                    placeholder="Phone"
                    class="form-control form-control-lg"
                  />
                </div>
                <div class="form-group">
                  <button
                    class="btn btn-info btn-block btn-lg"
                    @click="showAddModal=false"
                  >
                    Add user
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
          showAddModal: false,
          friends: [],
        },

        mounted: function () {
          //when this instance is created then all the methods called in this mounted function will execute automatically
          this.getAllFriends();
        },

        methods: {
          // method for getting all users from db and displaying them into the main page
          getAllFriends() {
            axios
              .get("..?action=read")
              .then(function (response) {
                if (response.data.error) {
                  //check for any error
                  app.errorMsg = response.data.message; //assign error message
                } else {
                  app.friends = response.data.users;
                }
              });
          },
        },
      });
      });
    </script>
  </body>
</html>
