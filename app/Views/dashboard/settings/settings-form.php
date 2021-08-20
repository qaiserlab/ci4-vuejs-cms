<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <form @submit.prevent="apply">
        <card :title="title">

          <alert v-if="response.status == 422" 
          title="Invalid"
          :data-source="response.data"
          @close="response.status = 0">
            Please correct following errors;
          </alert>

          <Directory :data-source="rsDirectory" @click="openCategory">
            <div v-if="directoryActive == 'general'">
              <h5>GENERAL</h5>
              <hr>

              <div class="row">
                <div class="col-md-2">
                  <label>Website URL</label>
                </div>
                <div class="col-md-10">
                  <textbox v-model="form.websiteUrl" 
                  invalid-field="websiteUrl" 
                  placeholder="Website URL"
                  :invalid-source="response"></textbox>
                </div>
              </div>
            </div>

            <div v-if="directoryActive == 'menu'">
              <h5>MENU</h5>
              <hr>

              <div class="row">
                <div class="col-md-6">
                  <jstree v-model="form.menu" 
                  invalid-field="menu" 
                  :invalid-source="response"></jstree>
                </div>
                
                <div class="col-md-5">
                  <jstree v-model="form.settingsMenu" 
                  invalid-field="settingsMenu" 
                  :invalid-source="response"></jstree>
                </div>
              </div>
              
            </div>

          </Directory>

        </card>

        <floatarea>
          <!-- <button_ color="info" 
          icon="undo"  
          @click="resetData"></button_> -->

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

        directoryActive: '',
        rsDirectory: [
          { id: 'general', title: 'General' },
          { id: 'menu', title: 'Menu' },
        ],
      },

      methods: {

        openCategory(key) {
          let settingsKey;
          let found = false;

          // for (settingsKey of Object.keys(this.form)) {
          //   if (this.form[settingsKey] != this.recordActive[settingsKey]) found = true;
          // }

          // if (found) {
          //   this.categoryKeyActive = key;
          //   this.applyDiscardModal = true;
          // }
          // else 
          this.directoryActive = key;
        },
        
        async apply() {
          console.log('apply');
          // this.loading = true;
          // if (!this.editSlug) this.form.slug = this.slug;

          // this.form.content = encodeURIComponent(this.form.content);
          
          // $.post(
          // baseURL('dashboard/content/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')), 
          // this.form, (result) => {
            
          //   if (result.status == 200) {
          //     window.location = baseURL('dashboard/content');
          //   }
              
          //   this.response = result;
          //   this.loading = false;
            
          //   $("html, body").animate({ scrollTop: 0 }, 900);
          // });
        },

      },

    });
  </script>
<?php $this->endSection() ?>