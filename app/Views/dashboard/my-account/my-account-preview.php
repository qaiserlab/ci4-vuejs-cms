<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <form @submit.prevent="submit">

        <div class="row">
          
          <div class="col-md-9">
            <card :title="title">

              <div class="row form-group">
                <label class="col-md-2">Fullname</label>
                <div class="col-md-10">
                  : <label_ :value="form.fullname"></label_>
                </div>
              </div>
              
              <div class="row form-group">
                <label class="col-md-2">Phone Number</label>
                <div class="col-md-10">
                  : <label_ :value="form.phoneNumber"></label_>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-2">Email</label>
                <div class="col-md-10">
                  : <label_ :value="form.email" type="email"></label_>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-2">Username</label>
                <div class="col-md-10">
                  : <label_ :value="form.username"></label_>
                </div>
              </div>
              
              <div v-if="form.group" class="row form-group">
                <label class="col-md-2">Group</label>
                <div class="col-md-10">
                  : <label_ :value="form.group.name"></label_>
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
          <button_ icon="key" 
          type="danger"
          :to="baseURL('dashboard/my-account/change-password')"></button_>

          <button_ icon="edit" 
          :to="baseURL('dashboard/my-account/edit')"></button_>
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
        publicationRecords: [
          'Published',
          'Draft',
        ],
      },
      
      methods: {
        
        async saveData() {
          this.loading = true;
          
          $.post(
          baseURL('dashboard/content/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')), 
          this.form, (result) => {
            
            if (result.status == 200) {
              window.location = baseURL('dashboard/content');
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