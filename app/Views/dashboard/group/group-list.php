<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <card title="List">

        <datatable :data-source="rs"
        :columns="['name', 'status', 'action']"
        :custom-columns="['status']"
        :columns-options="{
          status: { label: 'Status', width: '140px' },
          action: { width: '140px' },
        }"
        :options="{ 
          filterByColumn: true,
          filterable: ['name', 'status'],
          listColumns: {
            status: activationFilters,
          },
        }">
          <template slot="status" scope="data">
            <label_ :value="data.row.status" type="status"></label_>
          </template>

          <template slot="action" scope="data">
            <div class="action">
              <hyperlink icon="edit"
              :to="baseURL(`dashboard/group/edit?id=${data.row.id}`)">
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
        :to="baseURL('dashboard/group/new')"></button_>
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
        activationFilters: [
          { id: 'Active', text: 'Active' },
          { id: 'Unactive', text: 'Unactive' },
        ],
      },

      methods: {
        deleteData(record) {
          confirm('Delete data?', () => {
            this.loading = true;

            $.get(baseURL('dashboard/group/remove?id=' + record.id), (result) => {
              window.location = baseURL('dashboard/group');
            });
          });
        },
      },

    });
  </script>
<?php $this->endSection() ?>