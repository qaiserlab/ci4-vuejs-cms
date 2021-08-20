<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <form @submit.prevent="saveData" autocomplete="off">

        <div class="row">
          
          <div class="col-md-9">
            <card :title="title">
              
              <alert v-if="response.status == 422" 
              title="Invalid"
              :data-source="response.data"
              @close="response.status = ''">
                {{response.message}}
              </alert>

              <div class="row form-group">
                <label class="col-md-3">Firstname</label>
                <div class="col-md-9">
                  <textbox v-model="form.firstname"
                  invalid-field="firstname" 
                  placeholder="Firstname" 
                  :invalid-source="response"
                  focus></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">Lastname</label>
                <div class="col-md-9">
                  <textbox v-model="form.lastname"
                  invalid-field="lastname" 
                  placeholder="Lastname" 
                  :invalid-source="response"></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">Phone Number</label>
                <div class="col-md-9">
                  <textbox v-model="form.phoneNumber"
                  invalid-field="phoneNumber" 
                  placeholder="Phone Number" 
                  :invalid-source="response"></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">Email</label>
                <div class="col-md-9">
                  <textbox v-model="form.email"
                  invalid-field="email" 
                  placeholder="Email" 
                  :invalid-source="response"></textbox>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-3">Username</label>
                <div class="col-md-9">
                  <textbox v-model="form.username"
                  invalid-field="username" 
                  placeholder="Username" 
                  :invalid-source="response"></textbox>
                </div>
              </div>

              <!-- <div class="row form-group">
                <label class="col-md-3">Group</label>
                <div class="col-md-9">
                  <combobox v-model="form.groupId" 
                  field="name"
                  invalid-field="groupId" 
                  placeholder="Group"
                  :data-source="rsGroup" 
                  :invalid-source="response"></combobox>
                </div>
              </div> -->
              
              <span v-if="mode == 'create'">
                <div class="row form-group">
                  <label class="col-md-3">Password</label>
                  <div class="col-md-9">
                    <textbox v-model="form.password"
                    type="password"
                    invalid-field="password" 
                    placeholder="Password" 
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
              </span>

              <!-- <div class="row form-group">
                <label class="col-md-3">Email</label>
                <div class="col-md-9">
                  <textbox v-model="form.email"
                  invalid-field="email" 
                  placeholder="Email" 
                  :invalid-source="response"></textbox>
                </div>
              </div> -->

            </card>
          </div>

          <div class="col-md-3">
            <card title="Setup">

              <div class="row form-group">
                <div class="col-md-12">
                  <gallery v-model="form.image" 
                  store-slug="users"
                  invalid-field="image" 
                  placeholder="Image"
                  :invalid-source="response"></gallery>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <combobox v-model="form.groupId" 
                  field="name"
                  invalid-field="groupId" 
                  placeholder="Group"
                  :data-source="rsGroup" 
                  :invalid-source="response"></combobox>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-3">
                  <label>Status</label>
                </div>
                <div class="col-md-9">
                  <radio v-model="form.status" 
                  invalid-field="status" 
                  placeholder="Status"
                  :data-source="publicationRecords" 
                  :invalid-source="response"></radio>
                </div>
              </div>

            </card>
          </div>

        </div>

        <floatarea>
          <button_ color="info" 
          icon="arrow-left"  
          :to="baseURL('dashboard/user')"></button_>

          <button_ color="success" 
          icon="floppy-o" 
          :loading="loading" 
          submit></button_>
          
          <button_ v-if="mode == 'update'"
          icon="plus" 
          :to="baseURL('dashboard/user/new')"></button_>
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
        rsGroup: <?= json_encode($rsGroup) ?>,
        publicationRecords: [
          'Active',
          'Unactive',
        ],
      },
      
      methods: {
        
        async saveData() {
          this.loading = true;
          
          $.post(
          baseURL('dashboard/user/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')), 
          this.form, (result) => {
            
            if (result.status == 200) {
              window.location = baseURL('dashboard/user');
            }
              
            this.response = result;
            this.loading = false;
            
            $("html, body").animate({ scrollTop: 0 }, 900);
          }).fail((result) => {
            if (result.status == 500) {
              window.location = baseURL('dashboard/user');
            }
          });
        },

      },

    });
  </script>
<?php $this->endSection() ?>