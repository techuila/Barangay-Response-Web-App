<template>
	<div id="dashboard">
		<!-- MODAL ADD LOCATION -->
		<Modal type="m-add-loc" style="height: 200px !important">
			<template slot="modal-title"
				><span v-if="!isEditClicked">Add</span
				><span v-else>Edit</span> Location</template
			>
			<template slot="modal-content">
				<div class="row">
					<form
						class="col s12"
						id="add_loc_form"
						name="add_loc_form"
						@submit.prevent="updateLocation"
					>
						<div class="row">
							<div class="col s2">
								<div class="input-field">
									<input
										v-model="selLoc.name"
										type="text"
										name="name"
										id="name"
										disabled
									/>
									<label for="name">Name</label>
								</div>
							</div>
							<div class="col s12">
								<div class="input-field">
									<input
										v-model="selLoc.title"
										type="text"
										name="title"
										id="title"
										required
									/>
									<label for="title">Title</label>
								</div>
							</div>
							<div class="col s6">
								<div class="input-field">
									<input
										v-model="selLoc.long"
										type="text"
										name="long"
										id="long"
										required
									/>
									<label for="long">Longitude</label>
								</div>
							</div>
							<div class="col s6">
								<div class="input-field">
									<input
										v-model="selLoc.lat"
										type="text"
										name="lat"
										id="lat"
										required
									/>
									<label for="lat">Latitude</label>
								</div>
							</div>
							<button id="magic" type="submit" class="magic"></button>
						</div>
					</form>
				</div>
			</template>
			<template slot="modal-footer">
				<a class="modal-close waves-effect waves-red btn-flat red-text"
					>CANCEL</a
				>
				<a
					class="waves-effect waves-green btn-flat green-text"
					onclick="$('#magic').click();"
					><span v-if="!isEditClicked">SAVE</span><span v-else>UPDATE</span></a
				>
			</template>
		</Modal>

		<!-- MODAL DELETE LOCATION -->
		<Modal type="m-delete-loc" style="height: 250px !important">
			<template slot="modal-title">Delete Location</template>
			<template slot="modal-content">
				<p>Are you sure you want to delete this data?</p>
				<table>
					<thead>
						<th>ID</th>
						<th>Name</th>
						<th>Title</th>
						<th>Longitude</th>
						<th>Latitude</th>
						<th>Created At</th>
						<!-- <th>Status</th> -->
					</thead>
					<tbody>
						<tr>
							<td>{{ selLoc.id }}</td>
							<td>{{ selLoc.name }}</td>
							<td>{{ selLoc.title }}</td>
							<td>{{ selLoc.long }}</td>
							<td>{{ selLoc.lat }}</td>
							<!-- <td>{{selLoc.created_at}}</td> -->
							<td>{{ selLoc.status }}</td>
						</tr>
					</tbody>
				</table>
			</template>
			<template slot="modal-footer">
				<a class="waves-effect waves-light btn-flat red-text modal-close">NO</a>
				<a
					class="waves-effect waves-light btn-flat green-text modal-close"
					@click="deleteLocation"
					>YES</a
				>
			</template>
		</Modal>

		<!-- DASHBARD CONTENT -->
		<div class="row">
			<div class="col s8">
				<div class="card z-depth-3" style="height: 500px; overflow: hidden">
					<div id="map"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="card z-depth-3">
					<div class="card-content">
						<span class="card-title">Locations</span>
						<table class="highlight">
							<thead>
								<th>ID</th>
								<th>Name</th>
								<th>Message</th>
								<th>Type</th>
								<th>Longitude</th>
								<th>Latitude</th>
								<th>Sim Number</th>
								<th>Date Time Received</th>
								<!-- <th>Date Responded</th> -->
								<th>Status</th>
							</thead>
							<tbody>
								<tr v-for="(location, i) in locations.data" :key="location.id">
									<td>{{ i + 1 }}</td>
									<td>{{ location.client.name }}</td>
									<td>
										{{
											location.msg.trim() != ""
												? location.msg
												: "--No Message--"
										}}
									</td>
									<td>{{ location.title }}</td>
									<td>{{ location.long }}</td>
									<td>{{ location.lat }}</td>
									<td>{{ location.client.sim_number }}</td>
									<td>{{ location.created_at }}</td>
									<!-- <td></td> -->
									<td>
										<span class="orange-text text-dargen-4"
											><b>{{ location.status }}</b></span
										>
									</td>
									<td class="option">
										<a
											class="waves-effect waves-dark btn-flat"
											@click="flyToLocation(location.long, location.lat)"
											><i class="material-icons small blue-text text-darken-2"
												>remove_red_eye</i
											></a
										>
										<a
											class="waves-effect waves-dark btn-flat"
											@click="openEditModal(location.id)"
											style="margin: auto 25px"
											><i class="material-icons small orange-text text-darken-2"
												>edit</i
											></a
										>
										<a
											class="waves-effect waves-dark btn-flat"
											@click="openDeleteModal(location.id)"
											><i class="material-icons small red-text">delete</i></a
										>
									</td>
								</tr>
							</tbody>
						</table>
						<ul class="pagination">
							<li :class="{ disabled: locations.meta.current_page === 1 }">
								<a @click="pagination(1, true)"
									><i class="material-icons">chevron_left</i></a
								>
							</li>
							<li
								class="waves-effect"
								:class="{ active: a === locations.meta.current_page }"
								v-for="a in links"
								:key="a"
							>
								<a @click="pagination(a, false)">{{ a }}</a>
							</li>
							<li
								class="waves-effect"
								:class="{ disabled: locations.meta.current_page === links }"
							>
								<a @click="pagination(locations.meta.current_page + 1, true)"
									><i class="material-icons">chevron_right</i></a
								>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- <a @click="openAddModal()" href="#m-add-loc" class="modal-trigger btn-floating btn-large waves-effect waves-light z-depth-2 red" style="position: fixed; bottom: 15px; right: 15px;"><i class="material-icons">add</i></a> -->
	</div>
</template>

<script>
	import Modal from "../Modal";

	let map, dataset, pubnub;

	export default {
		components: {
			Modal,
		},
		data: () => ({
			points: [],
			selLoc: {
				id: "",
				name: "",
				title: "",
				long: "",
				lat: "",
				status: "",
			},
			link: {
				first: "",
				last: "",
				next: "",
				prev: "",
			},
			dummy_link: "",
			link_len: "",
			isEditClicked: false,
		}),
		created() {
			this.$store.dispatch("FETCH_LOCATIONS");
		},
		mounted() {
			/* ============================
				                    PUBNUB
				         ==============================*/
			pubnub = new PubNub({
				subscribeKey: "sub-c-8a113ba6-f2f0-11e8-b085-b2b44c5b7fba",
				publishKey: "pub-c-61ae752a-7971-4d89-9859-7d17f4deb0b9",
			});

			let that = this;

			pubnub.addListener({
				message: function (data) {
					if (data.message.name != localStorage.getItem("email")) {
						/* UDPATE TABLES */
						if (data.message.method == 1) {
							that.$store.commit("ADD_LOCATION", data.message.points);
						} else if (data.message.method == 2) {
							that.$store.commit("UPDATE_LOCATION", data.message.points);
						} else {
							that.$store.commit("DELETE_LOCATION", data.message.points);
						}

						/* UPDATE MAP */
						that.updateMap(data.message.method, data.message.points);

						/* Check if realtime data checkbox is turned off */
						if (!that.$store.getters.getRealtime)
							that.$store.commit("SET_SETTINGS", 1);
					}
				},
			});

			pubnub.subscribe({
				channels: ["mapbox"],
			});

			/* ============================
				                    MAPBOX
				         ==============================*/
			$(document).ready(() => {
				/* MAPBOX ACCES TOKEN */
				mapboxgl.accessToken = process.env.MAPBOX_TOKEN;

				/* CREATE INSTANCE OF MAPBOX */
				map = new mapboxgl.Map({
					container: "map", // container id
					style: "mapbox://styles/mapbox/streets-v9",
					center: [122.0818696, 6.9178086], // starting position
					zoom: 13, // starting zoom
				});

				// Add geolocate control to the map.
				map.addControl(
					new mapboxgl.GeolocateControl({
						positionOptions: {
							enableHighAccuracy: true,
						},
						trackUserLocation: true,
					})
				);

				setTimeout(() => {
					this.$forceUpdate();
					/* GET DATA FROM LOCATIONS (VUEX) */
					let loc = this.locations.data;
					for (let data in loc) {
						this.points.push({
							type: "Feature",
							geometry: {
								type: "Point",
								coordinates: [
									parseFloat(loc[data]["long"]),
									parseFloat(loc[data]["lat"]),
								],
							},
							properties: {
								title: loc[data]["title"],
								icon: "triangle",
							},
						});
					}
					dataset = {
						type: "FeatureCollection",
						features: this.points,
					};
				}, 1000);

				map.on("load", function () {
					map.addSource("locations", {
						type: "geojson",
						data: dataset,
					});

					map.addLayer({
						id: "points",
						type: "symbol",
						source: "locations",
						layout: {
							"icon-image": "{icon}-15",
							"text-field": "{title}",
							"text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
							"text-offset": [0, 0.6],
							"text-anchor": "top",
						},
					});
				});

				$(".mapboxgl-canvas").css({ width: "100%" });
			});
		},
		methods: {
			pagination(page, isChevronClicked) {
				if (
					(this.link.next != null &&
						isChevronClicked &&
						this.locations.meta.current_page != page) ||
					!isChevronClicked
				)
					this.$store.dispatch("FETCH_LOCATION_PAGE", page);
			},
			updateLocation() {
				if (!this.isEditClicked) {
					/* ADD LOCATION */
					M.toast({
						html:
							'<div v-if="false" class="preloader-wrapper small active">' +
							'<div class="spinner-layer spinner-green-only">' +
							'<div class="circle-clipper left">' +
							'<div class="circle"></div>' +
							'</div><div class="gap-patch">' +
							'<div class="circle"></div>' +
							'</div><div class="circle-clipper right">' +
							'<div class="circle"></div>' +
							"</div>" +
							"</div>" +
							'</div><span style="margin-left: 10px;">Loading. . .</span>',
						classes: "rounded",
						displayLength: 99999,
					});
					const formData = new FormData(document.forms.namedItem("add_loc_form"));
					axios
						.post("/api/location", formData)
						.then((res) => {
							$(".modal").modal("close");
							this.$store.commit("ADD_LOCATION", res.data);

							/* UPDATE MAP */
							this.updateMap(1, res.data);

							/* PUBLISH PUBNUB */
							this.publishPubnub(1, res.data);

							/* NOTIFY */
							M.Toast.dismissAll();
							M.toast({
								html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Done!</span>',
								displayLength: 2000,
								classes: "rounded",
							});

							/* Clear Textfields */
							this.clear();
						})
						.catch((err) => {
							M.Toast.dismissAll();
							M.toast({
								html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>',
								displayLength: 2000,
								classes: "rounded",
							});
							console.log(err);
						});
				} else {
					/* EDIT LOCATION */
					axios
						.put(`/api/location`, this.selLoc)
						.then((res) => {
							$(".modal").modal("close");
							this.$store.commit("UPDATE_LOCATION", res.data);

							/* UPDATE MAP */
							this.updateMap(2, res.data);

							/* PUBLISH PUBNUB */
							this.publishPubnub(2, res.data);

							/* NOTIFY */
							M.Toast.dismissAll();
							M.toast({
								html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Location Successfully Updated!</span>',
								displayLength: 1500,
								classes: "rounded",
							});
						})
						.catch((err) => {
							console.log(err);
						});
				}
			},
			deleteLocation() {
				axios
					.delete(`/api/location/${this.selLoc.id}`)
					.then((res) => {
						this.$store.commit("DELETE_LOCATION", res.data);

						/* UPDATE MAP */
						this.updateMap(3, res.data);

						/* PUBLISH PUBNUB */
						this.publishPubnub(3, res.data);

						M.Toast.dismissAll();
						M.toast({
							html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Location Successfully Deleted!</span>',
							displayLength: 1500,
							classes: "rounded",
						});
					})
					.catch((err) => {
						console.log(err);
					});
			},
			openAddModal() {
				this.clear();
				this.isEditClicked = false;
			},
			openDeleteModal(id) {
				this.selLoc = this.selectLocation(id);
				$("#m-delete-loc").modal("open");
			},
			openEditModal(id) {
				this.isEditClicked = true;
				let selLoc = this.selectLocation(id);
				this.selLoc.id = selLoc.id;
				this.selLoc.name = selLoc.client.name;
				this.selLoc.title = selLoc.title;
				this.selLoc.long = selLoc.long;
				this.selLoc.lat = selLoc.lat;
				this.selLoc.status = selLoc.status;

				$("#m-add-loc").modal("open");
				setTimeout(() => {
					M.updateTextFields();
				}, 100);
			},
			clear() {
				this.selLoc.id = "";
				this.selLoc.name = "";
				this.selLoc.title = "";
				this.selLoc.long = "";
				this.selLoc.lat = "";
				this.selLoc.status = "";
			},
			selectLocation(id) {
				return this.$store.getters.locations.data.find((loc) => loc.id == id);
			},
			flyToLocation(long, lat) {
				document.documentElement.scrollTop = 0;
				document.body.scrollTop = 0;
				map.flyTo({
					center: [parseFloat(long), parseFloat(lat)],
					zoom: 15,
				});
			},
			updateMap(i, point) {
				// let point = data;
				if (i == 1) {
					/* ADD MAP REALTIME */
					this.points.push({
						type: "Feature",
						geometry: {
							type: "Point",
							coordinates: [parseFloat(point.long), parseFloat(point.lat)],
						},
						properties: {
							title: point.title,
							icon: "triangle",
						},
					});
				} else if (i == 2) {
					/* UPDATE MAP REALTIME */
					const index = this.points.findIndex(
						(p) =>
							p.geometry.coordinates[0] == parseFloat(point.long) &&
							p.geometry.coordinates[1] == parseFloat(point.lat)
					);
					this.points[index] = {
						type: "Feature",
						geometry: {
							type: "Point",
							coordinates: [parseFloat(point.long), parseFloat(point.lat)],
						},
						properties: {
							title: point.title,
							icon: "triangle",
						},
					};
				} else {
					/* DELETE MAP REALTIME */
					const index = this.points.findIndex(
						(p) =>
							p.geometry.coordinates[0] == parseFloat(point.long) &&
							p.geometry.coordinates[1] == parseFloat(point.lat)
					);
					this.points.splice(index, 1);
				}

				dataset = {
					type: "FeatureCollection",
					features: this.points,
				};
				map.getSource("locations").setData(dataset);
			},
			publishPubnub(id, data) {
				/* PUBLISH PUBNUB */
				if (this.$store.getters.getRealtime) {
					pubnub.publish(
						{
							message: {
								method: id,
								points: data,
								name: localStorage.getItem("email"),
							},
							channel: "mapbox",
						},
						(status, response) => {
							if (!status.error) {
								console.log("Message Published w/ timetoken", response.timetoken);
							} else {
								console.log(status);
							}
						}
					);
				}
			},
		},
		computed: {
			locations() {
				this.link = this.$store.getters.locations.links;
				return this.$store.getters.locations;
			},
			links() {
				this.dummy_link = this.$store.getters.getLocationLen[0] + "=";
				return parseInt(this.$store.getters.getLocationLen[1]);
			},
		},
	};
</script>

<style scoped>
	#map {
		height: 500px;
		width: 100%;
		padding: 0;
	}
	tr {
		position: relative !important;
	}
	table.highlight tbody tr:hover .option {
		background-color: rgba(44, 62, 80, 0.2) !important;
		position: absolute;
		left: 0;
		right: 0;
		margin: 0 25px;
		max-height: 52px;
		display: flex;
		justify-content: center;
	}
	table.highlight tbody tr:hover td:not(.option) {
		filter: blur(4px);
	}
	.option {
		display: none;
		padding-top: 7px;
	}
	.card-content {
		position: relative;
		margin-bottom: 50px;
	}
	.pagination {
		position: absolute;
		bottom: -45px;
		left: 10px;
	}
	.pagination li:hover {
		cursor: pointer;
	}
</style>
