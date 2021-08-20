<?php namespace App\Libraries;

class JsWidget
{
  public function html($params = [])
  {
    $html = '';

    if (isset($params['loadData'])) {
      $model = new \App\Models\AlbumModel();
      $rsAlbum = $model->orderBy('id', 'desc')->findAll();
      
      $model = new \App\Models\PhotoModel();
      $rsPhoto = $model->orderBy('id', 'desc')->findAll();

      $html .= '
      <script>
        let gRsAlbum = '.json_encode($rsAlbum).';
        let gRsPhoto = '.json_encode($rsPhoto).';
      </script>
      ';
    }

    $html .= '
    <div id="splash"></div>

    <div id="alert" class="modal" tabindex="-1" role="dialog">
      <div class="modal-overlay"></div>

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Alert</h5>
            
            <button type="button" 
            class="close" 
            aria-label="Close">
              <i class="fa fa-close"></i>
            </button>
          </div>
          
          <div class="modal-body">
            <i class="fa fa-warning"></i>
            <span></span>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-ok">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div id="confirm" class="modal" tabindex="-1" role="dialog">
      <div class="modal-overlay"></div>

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm</h5>
            
            <button type="button" 
            class="close" 
            aria-label="Close">
              <i class="fa fa-close"></i>
            </button>
          </div>
          
          <div class="modal-body">
            <i class="fa fa-question-circle"></i>
            <span></span>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-ok">OK</button>
            <button type="button" class="btn btn-danger btn-cancel">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    ';

    $html .= "
    <script>

    $.ajaxSetup({
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
      //  'SameSite': 'None',
      },
      cache: false,
    });

    function baseURL(uri) {
      return '".base_url()."/' + uri;
    }

    function confirmLogout() {
      confirm('Logout from Application?', () => {
        window.location = baseURL('admin/logout');
      });
    }

    function getStatusColor(status) {
      let statusColors = {
        Active: 'success',
        Unactive: 'danger',
        Pending: 'primary',
        Freeze: 'info',
        Processed: 'warning',
        Delivered: 'success',
        Arrived: 'secondary',
        Read: 'secondary',
        Unread: 'warning',
        Published: 'success',
        Draft: 'secondary',
      };

      return statusColors[status];
    }

    function slugify(string) {
      const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;';
      const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnooooooooprrsssssttuuuuuuuuuwxyyzzz------';
      const p = new RegExp(a.split('').join('|'), 'g');
  
      return string.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with 'and'
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, ''); // Trim - from end of text
    }

    function splash(message) {
      $('#splash').html(message)

      $('#splash').fadeIn(() => {
        setTimeout(() => {
          $('#splash').fadeOut()
        }, 3000)
      })
    }

    $('#alert .btn-ok, #alert .close').on('click', () => {
      $('#alert').fadeOut()
    })

    function alert(message, callback) {
      $('#alert .modal-dialog').css('z-index', '10001')
      $('#alert .modal-body span').html(message)
      $('#alert').fadeIn()

      if (callback) {
        $('#alert .btn-ok').off('click')
        $('#alert .btn-ok').on('click', callback)
        $('#alert .btn-ok').on('click', () => {
          $('#alert').fadeOut()
        })
      }
    }

    $('#confirm .btn-cancel, #confirm .close').on('click', () => {
      $('#confirm').fadeOut()
    })

    function confirm(message, callback, cancelCallback) {
      $('#confirm .modal-dialog').css('z-index', '10001')
      $('#confirm .modal-body span').html(message)
      $('#confirm').fadeIn()

      if (callback) {
        $('#confirm .btn-ok').off('click')
        $('#confirm .btn-ok').on('click', callback)
        $('#confirm .btn-ok').on('click', () => {
          $('#confirm').fadeOut()
        })
      }
      
      if (cancelCallback) {
        $('#confirm .btn-cancel').off('click')
        $('#confirm .btn-cancel').on('click', cancelCallback)
        $('#confirm .btn-cancel').on('click', () => {
          $('#confirm').fadeOut()
        })
      }
    }

    </script>
    ";

    $splash = session()->getFlashdata('splash');

    if (!empty($splash)) {
      $html .= '<script>splash("'.$splash.'")</script>';
    }
    
    return $html;
  }
}