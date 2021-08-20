<?php 
$session = session();

$this->extend('layouts/dashboard'); 
$this->section('content');
?>
  <div id="content">
    <section>
      <card title="List">
        <datatable :data-source="rs"
        :columns="['fullname', 'phoneNumber', 'email', 'group.name', 'status', 'action']"
        :custom-columns="['status']"
        :columns-options="{
          phoneNumber: { label: 'Phone Number', width: '140px' },
          email: { width: '140px' },
          'group.name': { label: 'Group', width: '150px' },
          status: { label: 'Status', width: '140px' },
          action: { width: '250px' },
        }"
        :options="{ 
          filterByColumn: true,
          filterable: ['fullname', 'phoneNumber', 'email', 'group.name', 'status'],
          listColumns: {
            'group.name': groupFilters,
            status: activationFilters,
          },
        }">
          <template slot="status" scope="data">
            <label_ :value="data.row.status" type="status"></label_>
          </template>

          <template slot="action" scope="data">
            <div class="action">
              <small>
                <hyperlink icon="edit"
                :to="baseURL(`dashboard/user/edit?id=${data.row.id}`)">
                  Edit 
                </hyperlink>
                <hyperlink icon="close" 
                color="danger"
                @click="deleteData(data.row)">
                  Delete
                </hyperlink>
                
                <hyperlink icon="key"
                color="info"
                :to="baseURL(`dashboard/user/change-password?id=${data.row.id}`)">
                  Change Password
                </hyperlink>
              </small>
            </div>
          </template>
        </datatable>
      </card>

      <floatarea>
        <button_ icon="plus" 
        :to="baseURL('dashboard/user/new')"></button_>
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
        groupFilters: <?= json_encode($rsGroup) ?>,
        activationFilters: [
          { id: 'Active', text: 'Active' },
          { id: 'Unactive', text: 'Unactive' },
        ],
      },

      methods: {
        deleteData(record) {
          confirm('Delete data?', () => {
            this.loading = true;

            $.get(baseURL('dashboard/user/remove?id=' + record.id), (result) => {
              window.location = baseURL('dashboard/user');
            });
          });
        },
      },

    });
  </script>
<?php $this->endSection() ?>