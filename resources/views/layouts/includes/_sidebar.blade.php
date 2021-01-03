<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{url('/dashboard')}}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						@if(auth()->user()->level == 'Admin')
						<li><a href="{{url('/siswa')}}" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
						<li><a href="{{url('/guru')}}" class=""><i class="lnr lnr-user"></i> <span>Guru</span></a></li>
						@endif
					</ul>
				</nav>
			</div>
		</div>