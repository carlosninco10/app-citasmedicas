    @extends('template')

    @section('title','Panel')

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    @endpush

    @section('content')

    <div class="container-fluid table-index">
      <div class="row g-3 justify-content-between mb-3">
        <div class="col-md-4">
          <h5>Dashboard</h5>
        </div>
      </div>

      <section class="dash-overview">
        <div class="row g-4">
          <div class="col-lg-2 col-md-3 col-sm-4">
            <a href="#" class="card">
              <h1>10</h1>
              <p>AMD</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4">
            <a href="#" class="card">
              <h1>20</h1>
              <p>Alexa</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4">
            <a href="#" class="card">
              <h1>300</h1>
              <p>Amazon</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4">
            <a href="#" class="card">
              <h1>25</h1>
              <p>Alipay</p>
            </a>
          </div>
        </div>
      </section>
    </div>
    @endsection

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}" ></script>
    @endpush
