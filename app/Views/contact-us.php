<?php 
$this->extend('layouts/website'); 
$this->section('content');
?>
  <div id="contact-us" class="container">
    <section>
      <br>
      <h3><?= session()->get('title') ?></h3>
      <br>

      <form @submit.prevent="submit" class="content-box">
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
            :invalid-source="response"></textbox>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-2">Email</label>
          <div class="col-md-10">
            <textbox v-model="form.email"
            invalid-field="email" 
            placeholder="Email" 
            :invalid-source="response"></textbox>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-2">Phone Number</label>
          <div class="col-md-10">
            <textbox v-model="form.phoneNumber"
            invalid-field="phoneNumber" 
            placeholder="Phone Number" 
            :invalid-source="response"></textbox>
          </div>
        </div>

        <div class="row form-group">
          <label class="col-md-2">Subject</label>
          <div class="col-md-10">
            <textbox v-model="form.subject"
            invalid-field="subject" 
            placeholder="Subject" 
            :invalid-source="response"></textbox>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-12">
            <textarea_ v-model="form.message"
            invalid-field="message" 
            placeholder="Message" 
            :invalid-source="response"></textarea_>
          </div>
        </div>
        
        <button_ icon="paper-plane"  
        :loading="loading"
        submit>
          Send
        </button_>
      </form>
    </section>
  </div>
<?php 
$this->endSection(); 
$this->section('foot');
?>
  <script>
    new Vue({ 
      el: '#contact-us',
      data: {
        loading: false,
        response: {},
        form: {
          name: '',
          email: '',
          phoneNumber: '',
          subject: '',
          message: '',
        },
      },
      
      methods: {

        async submit() {
          this.loading = true;
          
          $.post(baseURL('contact-us/send-message'), this.form, (result) => {
            
            if (result.status == 200) {
              this.form.name = '';
              this.form.email = '';
              this.form.phoneNumber = '';
              this.form.subject = '';
              this.form.message = '';
              
              alert(result.message);
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