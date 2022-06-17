<template>
	<div>
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">TRANSAKSI OUTBOUND</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
							<li class="breadcrumb-item active">
								<span>Transaksi Outbound​</span>
							</li>

						</ol>
					</div>
				</div>
			</div>
		</div>

		<div class="content">
			<div class="container-fluid">
				<div class="col-12 col-md-12">
					<div class="card">
						<div class="card-header">Pilih Transaksi Outbound di bawah ini</div>
						<div class="card-body">
							<div class="row" style="margin-top: 150px;margin-bottom: 150px;">
								<div class="col-md-4 text-center">
									<router-link to=/outbound-transcation-1 class="btn btn-1">1</router-link>
									<br>
									<br>
									<label>OUTBOUND 1</label><br />
									<label>Part yang status pesawat masih didalam PLB GMF​</label>
								</div>
								<div class="col-md-4 text-center">
									<router-link to=/outbound-transcation-2 class="btn btn-2">2</router-link>
									<br>
									<br>
									<label>OUTBOUND 2</label><br />
									<label>Part yang status pesawat masih diluar PLB GMF​</label>
								</div>
								<div class="col-md-4 text-center">
									<router-link to=/outbound-transcation-3 class="btn btn-3">3
									</router-link>
									<br />
									<br />
									<label>OUTBOUND 3</label><br />
									<label>Part yang sudah menjadi Dokumen Clearance​</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<style>
.btn-1 {
	background-color: #f77b00;
	border: none;
	color: white;
	text-align: right;
	text-decoration: none;
	display: inline-block;
	font-size: 80px;
	cursor: pointer;
	padding-right: 45px;
	padding-left: 45px;
	border-radius: 50%;
}

.btn-2 {
	background-color: #f77b00;
	border: none;
	color: white;
	text-align: right;
	text-decoration: none;
	display: inline-block;
	font-size: 80px;
	cursor: pointer;
	padding-right: 45px;
	padding-left: 45px;
	border-radius: 50%;
}

.btn-3 {
	background-color: #f77b00;
	border: none;
	color: white;
	text-align: right;
	text-decoration: none;
	display: inline-block;
	font-size: 80px;
	cursor: pointer;
	padding-right: 45px;
	padding-left: 45px;
	border-radius: 50%;
}
</style>

<script>
export default {
	mounted() {
		console.log("Component mounted.");
	},
};
</script>
