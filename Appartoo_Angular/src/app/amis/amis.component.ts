import { Component, OnInit } from "@angular/core";
import { AppartooService } from "../Services/Appartoo.service";
import { Router } from "@angular/router";

@Component({
  selector: "app-amis",
  templateUrl: "./amis.component.html",
  styleUrls: ["./amis.component.css"]
})
export class AmisComponent implements OnInit {
  marsupilamis = [];
  currentUSer: any;
  testAmi: boolean = false;
  marsupilami = {
    id: null,
    username: null,
    password: null,
    email: null,
    age: null,
    email_canonical: null,
    salt: null,
    famille: null,
    couleur: null,
    nourriture: null,
    amis: []
  };
  constructor(private service: AppartooService, private router: Router) {}

  ngOnInit() {
    if(localStorage.getItem('id')==null)  this.router.navigate(['login'])
    this.currentUSer = localStorage.getItem("id");
    console.log(this.currentUSer);
    this.service.getAll().subscribe(all => {
      this.getMarsupilami();
      for (let user of all) {
        if (user.id != this.currentUSer) {
          for(let ami of user.amis){
            if(ami.id==this.currentUSer) user.username_canonical = "ami";
          }
          console.log(user)
          this.marsupilamis.push(user);          
            }
          }
    });
  }
  adamis(id1, id2) {
    let ressource = {
      id1: id1,
      id2: id2
    };
    this.service.AddAmis(ressource).subscribe(resp => {
          for(let m of this.marsupilamis){
            if(m.id == id2) m.username_canonical = "ami"
          }
    });
  }

  supamis(id1, id2) {
    
    let ressource = {
      id1: id1,
      id2: id2
    };
    this.service.SupAmis(ressource).subscribe(resp => {
      for(let m of this.marsupilamis){
        if(m.id == id2) m.username_canonical = "!ami"
      }

    });
  }


  getMarsupilami() {
    this.service.get(this.currentUSer).subscribe(resp => {
      var other = this;
      this.marsupilami = resp;
    });
  }
}
