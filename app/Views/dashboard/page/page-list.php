<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <card title="List">

        <datatable :data-source="rs"
        :columns="['title', 'status', 'action']"
        :custom-columns="['title', 'status']"
        :columns-options="{
          status: { label: 'Status', width: '140px' },
          action: { width: '140px' },
        }"
        :options="{ 
          filterByColumn: true,
          filterable: ['title', 'status'],
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
              :to="baseURL(`dashboard/page/edit?id=${data.row.id}`)">
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
        :to="baseURL('dashboard/page/new')"></button_>
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
        publicationFilters: [
          { id: 'Published', text: 'Published' },
          { id: 'Draft', text: 'Draft' },
        ],
      },

      methods: {
        deleteData(record) {
          confirm('Delete data?', () => {
            this.loading = true;

            $.get(baseURL('dashboard/page/remove?id=' + record.id), (result) => {
              window.location = baseURL('dashboard/page');
            });
          });
        },
      },

    });
  </script>
<?php $this->endSection() ?>