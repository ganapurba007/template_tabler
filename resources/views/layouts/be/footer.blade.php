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

  @stack('scripts')
</body>
</html>
