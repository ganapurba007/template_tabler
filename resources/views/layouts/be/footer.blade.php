      <!-- Footer Bar -->
      <footer class="app-footer">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <div>© {{ date('Y') }} LMS Dani — Admin &amp; Teacher Portal</div>
          <div>Inspired by Tabler. Built with Bootstrap 5.</div>
        </div>
      </footer>
    </div>
  </div>

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5 JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS CDN -->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

  <!-- ApexCharts CDN -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <!-- Custom Scripts -->
  <script src="{{ asset('template/be/assets/js/theme-toggle.js') }}"></script>
  <script src="{{ asset('template/be/assets/js/sidebar.js') }}"></script>

  <!-- Global DataTable Auto-Init (kelas: data-table) -->
  <script>
  $(document).ready(function() {
    if ($.fn.DataTable) {
      // Suppress DataTables alert warnings (use console instead)
      $.fn.dataTable.ext.errMode = 'none';

      $('table.data-table').each(function() {
        $(this).DataTable({
          responsive: true,
          columnDefs: [{ orderable: false, targets: -1 }],
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: "Berikutnya",
              previous: "Sebelumnya"
            }
          }
        });
      });
    }
  });
  </script>

  <!-- Global Auto-Dismiss Alerts -->
  <script>
  $(document).ready(function() {
    // Auto-dismiss alerts: success/info setelah 4 detik, warning/danger setelah 7 detik
    $('.alert').each(function() {
      var $alert = $(this);
      var delay = ($alert.hasClass('alert-warning') || $alert.hasClass('alert-danger')) ? 7000 : 4000;
      setTimeout(function() {
        $alert.fadeTo(500, 0).slideUp(300, function() {
          $(this).remove();
        });
      }, delay);
    });
  });
  </script>

  @stack('scripts')
</body>
</html>
