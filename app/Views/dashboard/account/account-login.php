<?php 
$this->extend('layouts/dashboard-login'); 
$this->section('content');
?>
  <div id="login" class="login-box">
    <div class="login-logo">
      <a href="https://www.sribulancer.com/id/users/qaiserlab">
        <img src="<?= base_url('assets/images/qaiserlab-sticker.png') ?>" alt="">
      </a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session.</p>

        <form @submit.prevent="submit">
          <alert v-if="response.status == 422" 
          title="Invalid"
          :data-source="response.data"
          @close="response.status = ''">
            {{response.message}}
          </alert>

          <div class="input-group mb-3">
            <input v-model="form.username"
            type="text" 
            class="form-control" 
            placeholder="Username">
            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input v-model="form.password"
            type="password" 
            class="form-control" 
            placeholder="Password">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div> -->
            </div>
            <div class="col-4">
              <button_ icon="lock"  
              :loading="loading"
              submit>
                Sign In
              </button_>
            </div>
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fa fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
      
        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
        <p class="mb-0">
          <a href="<?= base_url() ?>" class="text-center">Back to Website</a>
        </p>
      </div>

    </div>
  </div>

<?php 
$this->endSection(); 
$this->section('foot');
?>
  <script>
    new Vue({ 
      el: '#login',

      data: {
        loading: false,
        response: {},
        form: {
          username: '',
          password: '',
        },
      },

      methods: {

        async submit() {
          this.loading = true;
          
          $.post(baseURL('admin/login'), this.form, (result) => {
            if (result.status == 200) {
              window.location = baseURL('dashboard');
            }
            
            this.response = result;
            this.loading = false;
            
            $("html, body").animate({ scrollTop: 0 }, 900);
          });
        },

      },

    });
  </script>
<?php $this->endSection() ?>
