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
                <label class="col-md-1">Title</label>
                
                <div class="col-md-11">
                  <div class="form-group">
                    <sup>
                      <div v-if="!editSlug">
                        <i>
                          <b>Slug:</b>
                          {{ slug }}
                        </i>
                        <a href="javascript:"
                        @click="form.slug = slug; editSlug = true">
                          <i class="fa fa-edit"></i>Edit
                        </a>
                      </div>
                      <div v-else>
                        <i>
                          <b>Slug</b>
                        </i>
                        <textbox v-model="form.slug"
                        invalid-field="slug" 
                        placeholder="Slug" 
                        :invalid-source="response"
                        @input="if (!form.slug) form.slug = slug"></textbox>
                      </div>
                    </sup>

                    <textbox v-model="form.title"
                    invalid-field="title" 
                    placeholder="Title" 
                    :invalid-source="response"
                    focus></textbox>
                  </div>
                </div>
              </div>

            </card>
          </div>

          <div class="col-md-3">
            <card title="Setup">

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

          <div class="col-md-12">
            <card v-for="(banner, key) in form.banners"
            :key="key"
            :header="false"
            :footer="true">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <gallery v-model="banner.image" 
                    store-slug="banners"
                    min-height="380px"></gallery>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <textbox v-model="banner.url"
                    placeholder="URL"></textbox>
                  </div>
                  <div class="form-group">
                    <textbox v-model="banner.title"
                    placeholder="Title"></textbox>
                  </div>
                  <div class="form-group">
                    <textarea_ v-model="banner.content"
                    placeholder="Content"></textarea_>
                  </div>
                </div>
              </div>

              <template v-slot:footer>
                <button_ icon="plus" @click="addData"></button_>&nbsp;
                <button_ icon="minus" 
                type="danger" 
                :disabled="form.banners.length == 1"
                @click="removeData(key)"></button_>
              </template>
            </card>
          </div>

        </div>
        
        <floatarea>
          <button_ color="info" 
          icon="arrow-left"  
          :to="baseURL('dashboard/content/banner')"></button_>

          <button_ color="success" 
          icon="floppy-o" 
          :loading="loading" 
          submit></button_>
          
          <button_ v-if="mode == 'update'"
          icon="plus" 
          :to="baseURL('dashboard/content/banner/new')"></button_>
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
        form: <?= isset($record)?json_encode($record):'{ slug: "" }' ?>,
        loading: false,
        editSlug: false,
        response: {},
        publicationRecords: [
          'Published',
          'Draft',
        ],
      },

      computed: {
        slug() {
          return (this.form.title)?slugify(this.form.title):'';
        },
      },

      mounted() {
        if (this.form.slug != this.slug) this.editSlug = true;
      },
      
      methods: {

        addData() {
          this.form.banners.push({
            title: '',
            banners: [
              { image: '', title: '', content: '', tabActive: 1 },
            ],
            status: 'Published',
          });

          $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        },

        removeData(index) {
          this.form.banners.splice(index, 1);
        },
        
        async saveData() {
          this.loading = true;
          if (!this.editSlug) this.form.slug = this.slug;
          
          $.post(
          baseURL('dashboard/content/banner/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')), 
          this.form, (result) => {
            
            if (result.status == 200) {
              window.location = baseURL('dashboard/content/banner');
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