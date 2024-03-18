@extends('admin.layouts')

@section('title')
Dashboard Admin | Campus Today
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_user}}</h3>
              
              <p>Users</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_user_admin}} Admin</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_user_nonadmin}} Nonadmin</div>
            </div>
          </div>
          <a href={{route('admin.user.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_materi}}</h3>
              
              <p>Materials</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_materi_teks}} Teks</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_materi_video}} Video</div>
            </div>
          </div>
          <a href={{route('admin.materi.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_tryout}}</h3>
              
              <p>Tryouts</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_tryout_active}} Active</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_tryout_nonactive}} Nonactive</div>
            </div>
          </div>
          <a href={{route('admin.tryout.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_latihan}}</h3>
              
              <p>Latihans</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_latihan_active}} Active</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_latihan_nonactive}} Nonactive</div>
            </div>
          </div>
          <a href={{route('admin.latihan.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_event_tryout}}</h3>
              
              <p>Event Tryouts</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_event_tryout_active}} Active</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_event_tryout_nonactive}} Nonactive</div>
            </div>
          </div>
          <a href={{route('admin.event.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_packet_history}}</h3>
              
              <p>Packets</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
            </div>
          </div>
          <a href={{route('admin.packet.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-light" style="background-color: #6610f2;">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_packet_history}}</h3>
              
              <p>Packet Histories</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-warning border-0" style="width: auto">{{$jumlah_packet_history_pending}} Pending</div> <br>
              <div class="badge bg-info border-0" style="width: auto">{{$jumlah_packet_history_verification}} Verification</div> <br>
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_packet_history_success}} Success</div>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_packet_history_failed}} Failed</div>
            </div>
          </div>
          <a href={{route('admin.packethistory.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div style="display: flex">
            <div class="inner p-2" style="width: 40%">
              <h3>{{$jumlah_article}}</h3>
              
              <p>Articles</p>
            </div>
            <div class="p-2" style="width: 60%; text-align: end;">
              <div class="badge bg-success border-0" style="width: auto">{{$jumlah_article_active}} Active</div> <br>
              <div class="badge bg-danger border-0" style="width: auto">{{$jumlah_article_nonactive}} Nonactive</div>
            </div>
          </div>
          <a href={{route('admin.article.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
          <div class="inner">
            <h3>{{$jumlah_testimoni}}</h3>

            <p>Testimoni</p>
          </div>
          <a href={{route('admin.testimoni.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$jumlah_tes_minat_bakat}}</h3>

            <p>Tes Minat Bakat</p>
          </div>
          <a href={{route('admin.minatbakat.index')}} class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
    