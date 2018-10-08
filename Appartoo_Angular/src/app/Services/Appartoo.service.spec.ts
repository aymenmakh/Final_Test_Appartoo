/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { AppartooService } from './Appartoo.service';

describe('Service: Appartoo', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AppartooService]
    });
  });

  it('should ...', inject([AppartooService], (service: AppartooService) => {
    expect(service).toBeTruthy();
  }));
});
