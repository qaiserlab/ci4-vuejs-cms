<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <form ref="form" 
      method="post"
      @submit.prevent="saveData">

        <div class="row">
          
          <div class="col-md-9">
            <card :title="title">
              
              <alert v-if="response.status == 422" 
              title="Invalid"
              :data-source="response.data"
              @close="response.status = ''">
                {{response.message}}
              </alert>

              <div class="row">
                <label class="col-md-2">Title</label>
                
                <div class="col-md-10">
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

              <div class="row form-group">
                <label class="col-md-2">Content</label>
                <div class="col-md-10">
                  <trumbowyg v-model="form.content"
                  invalid-field="content" 
                  placeholder="Content" 
                  :invalid-source="response"></trumbowyg>
                </div>
              </div>

            </card>
          </div>

          <div class="col-md-3">
            <card title="Setup">

              <div class="row form-group">
                <div class="col-md-12">
                  <gallery v-model="form.image" 
                  store-slug="pages"
                  invalid-field="image" 
                  placeholder="Image"
                  :invalid-source="response"></gallery>
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
          :to="baseURL('dashboard/page')"></button_>

          <button_ color="success" 
          icon="floppy-o" 
          :loading="loading" 
          submit></button_>
          
          <button_ v-if="mode == 'update'"
          icon="plus" 
          :to="baseURL('dashboard/page/new')"></button_>
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
        
        async saveData(event) {
          const url = baseURL(
            'dashboard/page/' + this.mode + ((this.mode == 'update')?'?id=' + this.form.id:'')
          );
          
          this.loading = true;
          if (!this.editSlug) this.form.slug = this.slug;

          $.post(url, this.form, (result) => {

            if (result.status == 200) {
              $.each(this.form, (key, value) => {
                $('<input />')
                .attr('type', 'hidden')
                .attr('name', key)
                .attr('value', value)
                .appendTo(this.$refs.form);
              });

              $(this.$refs.form).attr('action', url);
              this.$refs.form.submit();
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