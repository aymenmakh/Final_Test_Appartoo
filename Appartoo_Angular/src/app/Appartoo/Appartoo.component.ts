import { Component, OnInit } from "@angular/core";
import { ActivatedRoute, Params } from "@angular/router";
import { AppartooService } from "../Services/Appartoo.service";
import { Router } from "@angular/router";

@Component({
  selector: "app-Appartoo",
  templateUrl: "./Appartoo.component.html",
  styleUrls: ["./Appartoo.component.css"]
})
export class AppartooComponent implements OnInit {
  id: any;
  marsupilami = {
    id : null,
    username :null,
    password : null,
    email : null,
    age : null,
    email_canonical : null,
    salt : null,
    famille :null,
    couleur : null,
    nourriture : null,
  };
  constructor(private route: ActivatedRoute,private service:AppartooService,private router: Router) {}

  ngOnInit() {
    if(localStorage.getItem('id')==null)  this.router.navigate(['login'])
    this.route.params.subscribe((params: Params) => {
      this.id = params["id"];
    });
    this.service.get(this.id).subscribe(resp =>{
      var other = this;
      this.marsupilami =resp
      console.log(this.marsupilami)
    })
    
  }
  goToModif(){
    this.router.navigate(['modif',this.marsupilami.id]);
  }

}
