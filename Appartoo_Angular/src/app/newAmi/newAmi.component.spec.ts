/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { NewAmiComponent } from './newAmi.component';

describe('NewAmiComponent', () => {
  let component: NewAmiComponent;
  let fixture: ComponentFixture<NewAmiComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NewAmiComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NewAmiComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
