/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { AppartooComponent } from './Appartoo.component';

describe('AppartooComponent', () => {
  let component: AppartooComponent;
  let fixture: ComponentFixture<AppartooComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AppartooComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AppartooComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
