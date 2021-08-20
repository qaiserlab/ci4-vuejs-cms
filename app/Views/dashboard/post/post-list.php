<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <card title="List">
        
        <div class="row form-group">
          <div class="col-md-12">
          
            <datepicker v-model="form.postedOn" 
            type="monthly"
            @input="reload"></datepicker>
            
          </div>
        </div>
        
        <datatable :data-source="rs"
        :columns="['title', 'postedOnHumanize', 'status', 'action']"
        :custom-columns="['title', 'status']"
        :columns-options="{
          postedOnHumanize: { label: 'Posted On', width: '180px' },
          status: { label: 'Status', width: '140px' },
          action: { width: '140px' },
        }"
        :options="{ 
          filterByColumn: true,
          filterable: ['title', 'postedOnHumanize', 'status'],
          listColumns: {
            status: publicationFilters,
          },
        }">
          <template slot="title" scope="data">
            {{data.row.title}}<br>
            <sup>
              <a :href="data.row.url" target="_blank">{{data.row.url}}</a>
            </sup>
          </template>

          <template slot="status" scope="data">
            <label_ :value="data.row.status" type="status"></label_>
          </template>

          <template slot="action" scope="data">
            <div class="action">
              <hyperlink icon="edit"
              :to="baseURL(`dashboard/post/edit?id=${data.row.id}`)">
                Edit 
              </hyperlink>
              <hyperlink icon="close" 
              color="danger"
              @click="deleteData(data.row)">
                Delete
              </hyperlink>
            </div>
          </template>
        </datatable>
      </card>

      <floatarea>
        <button_ icon="plus" 
        :to="baseURL('dashboard/post/new')"></button_>
      </floatarea>
      
    </section>
  </div>
<?php 
$this->endSection(); 
$this->section('foot');
?>
  <script>
    new Vue({ 
      el: '#content',
      
      data: {
        rs: <?= json_encode($rs) ?>,
        form: {
          postedOn: '<?= $postedOn ?>',
        },
        publicationFilters: [
          { id: 'Published', text: 'Published' },
          { id: 'Draft', text: 'Draft' },
        ],
      },

      methods: {
        reload() {
          window.location = baseURL('dashboard/post?postedOn=' + this.form.postedOn);
        },

        deleteData(record) {
          confirm('Delete data?', () => {
            this.loading = true;

            $.get(baseURL('dashboard/post/remove?id=' + record.id), (result) => {
              window.location = baseURL('dashboard/post');
            });
          });
        },
      },

    });
  </script>
<?php $this->endSection() ?>