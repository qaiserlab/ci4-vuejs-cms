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

              <div class="row form-group">
                <label class="col-md-2">Name</label>
                
                <div class="col-md-10">
                  <textbox v-model="form.name"
                  invalid-field="name" 
                  placeholder="Name" 
                  :invalid-source="response"
                  focus></textbox>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-2">Menu</label>
                <div class="col-md-5">
                  <checktree v-model="form.menu"
                  invalid-field="menu" 
                  :invalid-source="response"></checktree>
                </div>
                <div class="col-md-5">
                  <checktree v-model="form.settingsMenu"
                  invalid-field="settingsMenu" 
                  :invalid-source="response"></checktree>
                </div>
              </div>

            </card>
          </div>

          <div class="col-md-3">
            <card title="Setup">

              <div class="row">
                <div class="col-md-3">
                  <label>Status</label>
                </div>
                <div class="col-md-9">
                  <radio v-model="form.status" 
                  invalid-field="status" 
                  placeholder="Status"
                  :data-source="activationRecords" 
                  :invalid-source="response"></radio>
                </div>
              </div>
            
            </card>
          </div>

        </div>
        
        <floatarea>
          <button_ color="info" 
          icon="arrow-left"  
          :to="baseURL('dashboard/group')"></button_>

          <button_ color="success" 
          icon="floppy-o" 
          :loading="loading" 
          submit></button_>
          
          <button_ v-if="mode == 'update'"
          icon="plus" 
          :to="baseURL('dashboard/group/new')"></button_>
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
          
          $.post(
          baseURL('dashboard/group/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')), 
          this.form, (result) => {
            
            if (result.status == 200) {
              window.location = baseURL('dashboard/group');
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