<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <form @submit.prevent="saveData">

        <div class="row">
          
          <div class="col-md-9">
            <card :title="title">
              
              <alert v-if="response.status == 422" 
              title="Invalid"
              :data-source="response.data"
              @close="response.status = ''">
                {{response.message}}
              </alert>

              <!-- <div class="row form-group">
                <div class="col-md-3">
                  <label>Fullname</label>
                </div>
                <div class="col-md-9">
                  <label_ :value="form.fullname"></label_>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3">
                  <label>Username</label>
                </div>
                <div class="col-md-9">
                  <label_ :value="form.username"></label_>
                </div>
              </div> -->

              <div class="row form-group">
                <label class="col-md-3">Old Password</label>
                <div class="col-md-9">
                  <textbox v-model="form.oldPassword"
                  type="password"
                  invalid-field="oldPassword" 
                  placeholder="Old Password" 
                  :invalid-source="response"
                  focus></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">New Password</label>
                <div class="col-md-9">
                  <textbox v-model="form.newPassword"
                  type="password"
                  invalid-field="newPassword" 
                  placeholder="New Password" 
                  :invalid-source="response"></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">Retype Password</label>
                <div class="col-md-9">
                  <textbox v-model="form.retypePassword"
                  type="password"
                  invalid-field="retypePassword" 
                  placeholder="Retype Password" 
                  :invalid-source="response"></textbox>
                </div>
              </div>
              
            </card>
          </div>

          <div class="col-md-3">
            <card title="Info">

              <div class="row form-group">
                <div class="col-md-12">
                  <thumbnail :value="form.photo"></thumbnail>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-3">
                  <label>Status</label>
                </div>
                <div class="col-md-9">
                  : <label_ :value="form.status" type="status"></label_>
                </div>
              </div>

            </card>
          </div>

        </div>
        
        <floatarea>
          <button_ color="info" 
          icon="arrow-left"  
          :to="baseURL('dashboard/my-account')"></button_>

          <button_ color="success" 
          icon="floppy-o" 
          :loading="loading" 
          submit></button_>
        </floatarea>
        
      </form>
    </section>
  <div>
<?php 
$this->endSection(); 
$this->section('foot');
?>
  <script>
    new Vue({ 
      el: '#content',
      data: {
        title: '<?= $title ?>',
        mode: '<?= $mode ?>',
        form: <?= isset($record)?json_encode($record):'{}' ?>,
        loading: false,
        response: {},
        activationRecords: [
          'Active',
          'Unactive',
        ],
      },
      
      methods: {
        
        async saveData() {
          this.loading = true;

          $.post(baseURL('dashboard/my-account/update-password'), 
          this.form, (result) => {
            
            if (result.status == 200) {
              window.location = baseURL('dashboard/my-account');
            }
              
            this.response = result;
            this.loading = false;
            
            $("html, body").animate({ scrollTop: 0 }, 900);
          }).fail((result) => {
            if (result.status == 500) {
              window.location = baseURL('dashboard/my-account');
            }
          });
        },

      },

    });
  </script>
<?php $this->endSection() ?>