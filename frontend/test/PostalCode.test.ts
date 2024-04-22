import { PostalCode } from '../src/infra/domain/PostalCode';

test("Should have a Address", function () {
  const postalCode = new PostalCode("01512010", "São Paulo");
  expect(postalCode.postalCode).toBe("01512010");
  expect(postalCode.city).toBe("São Paulo");
});
