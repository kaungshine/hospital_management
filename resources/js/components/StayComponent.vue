<template>
<div class="row">
			<!-- Basic Form-->
			<div class="col-lg-6">
				<div class="card">
					<div class="card-close">
						<div class="dropdown">
							<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
						</div>
					</div>
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Stay Form</h3>
					</div>
					<div class="card-body">
						<form class="form-horizontal" method="POST" :action="url">
              <input type="hidden" name="_token" :value="csrf">
							<div class="form-group row">
                <div class="col-sm-12">
                  <select name="patient" class="form-control mb-3">
                    <option value selected>Choose Patient</option>
                    <option v-for="(patient, index) in patients" :key="index" :value="patient.id">
                      {{ patient.user.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
              	<div class="col-sm-6">
              		<select name="floor" v-model="floor" class="form-control mb-3">
                    <option value=-1 selected>Choose floor</option>
                    <option v-for="(floor, index) in floors" :key="index">{{ floor.blockfloor }}</option>
                  </select>
              	</div>
              	<div class="col-sm-6">
              		<select name="code" v-model="code" class="form-control mb-3">
                    <option value=-1 selected>Choose Code</option>
                    <option v-for="(code, index) in codes" :key="index">{{ code.blockcode }}</option>
                  </select>
              	</div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <select name="status" v-model="status" class="form-control mb-3">
                    <option value=-1 selected>Status</option>
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select name="room" v-model="room" class="form-control mb-3">
                    <option value=-1 selected>Choose Room</option>
                    <option v-for="(room, index) in rooms" :key="index" :value="room.id">{{ room.roomtype }}</option>
                  </select>
                </div>
              </div>
							<div class="form-group row">
								<label class="col-sm-3 form-control-label">Start Date</label>
								<div class="col-sm-9">
									<input id="inputHorizontalWarning" type="date" class="form-control form-control-warning" name="startdate">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 form-control-label">End Date</label>
								<div class="col-sm-9">
									<input id="inputHorizontalWarning1" type="date" class="form-control form-control-warning" name="enddate">
								</div>
							</div>
							<div class="form-group row">       
								<div class="col-sm-9 offset-sm-3">
									<input type="submit" value="Save" :disabled="disable" class="btn btn-info">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
        <div class="card">
          <div class="card-close">
            <div class="dropdown">
              <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
              <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
            </div>
          </div>
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Room Table</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">  
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Room Type</th>
                    <th>Block Floor</th>
                    <th>Block Code</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    <tr style="cursor: pointer;" v-for="(row, index) in filteredData" :key="index" @click="clickRow($event)" :data-id="row.id">
                        <td>{{index + 1}}</td>
                        <td>{{row.roomtype}}</td>     
                        <td>{{row.blockfloor}}</td>
                        <td>{{row.blockcode}}</td>
                        <td>
                          <div v-if="row.unavailable == 1" class="alert alert-success" role="alert">
                            Available
                          </div>
                          <div v-else class="alert alert-danger" role="alert">
                            Unavailable
                          </div>
                        </td>                     
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
			</div>
		</div>
</template>
<script>
	export default{
    data() {
      return {
        floor: -1,
        code: -1,
        room: -1,
        status: -1,
        sot_rooms: [],
        disable: false
      }
    },
    mounted(){
      this.sot_rooms = this.rooms
    },
    props: {
      patients: Array,
      rooms: Array,
      codes: Array,
      floors: Array,
      url: String,
      csrf: String 
    },
    computed: {
      filteredData(){
        let values = this.sot_rooms
        values = values.filter((element) => {
          // console.log(this.room)
          let flag1 = true
          let flag2 = true
          let flag3 = true
          let flag4 = true
          if(Number(this.floor) !== -1){
            flag1 = element.blockfloor == this.floor
          }
          if(Number(this.code) !== -1){
            flag2 = element.blockcode == this.code
          }
          if(Number(this.room) !== -1){
            flag3 = element.id == this.room
          }
          if(Number(this.status) !== -1){
            flag4 = element.unavailable == this.status
          }
          return flag1 && flag2 && flag3 && flag4
        })
        return values
      },
    },
    methods: {
      clickRow: function(event){
        console.log('Hello')
        let id = $(event.target).closest('tr').data('id')
        let chosen_row = this.sot_rooms.filter(element => {
          return element.id === id
        })
        this.floor = chosen_row[0].blockfloor
        this.code = chosen_row[0].blockcode
        this.room = chosen_row[0].id
        if(chosen_row[0].unavailable === 0)
          this.disable = true
        else
          this.disable = false
        this.status = chosen_row[0].unavailable
      }
    }
	}
</script>