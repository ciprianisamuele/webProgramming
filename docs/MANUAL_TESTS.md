# Manual Test Checklist

This file documents the principal workflows tested during development. It is not a record of automated test execution.

## Authentication

- [ ] Register a new user with valid information.
- [ ] Attempt registration with missing required fields.
- [ ] Attempt registration using an existing email address.
- [ ] Log in with valid credentials.
- [ ] Attempt login with an invalid password.
- [ ] Attempt login with an unknown email address.
- [ ] Confirm that the authenticated session persists between pages.
- [ ] Log out and confirm that protected session data is cleared.

## Profiles

- [ ] Open the current user's profile.
- [ ] Update supported account information.
- [ ] Upload or change a profile image.
- [ ] Confirm fallback behaviour when no custom image is available.

## Listings

- [ ] Publish a listing with all required fields.
- [ ] Publish a listing with one image.
- [ ] Publish a listing with multiple images.
- [ ] Attempt submission without a required field.
- [ ] Confirm that text, price, address, and contact information are stored.
- [ ] Confirm that uploaded images are displayed correctly.

## Maps and search

- [ ] Convert a valid address into latitude and longitude.
- [ ] Handle an invalid or incomplete address.
- [ ] Display listings on the map.
- [ ] Search by supported location input.
- [ ] Navigate between result pages.
- [ ] Confirm that selected results correspond to the displayed map data.

## Messaging

- [ ] Start a conversation with another user.
- [ ] Send a message.
- [ ] Retrieve and display the latest messages.
- [ ] Confirm sender and receiver identifiers.
- [ ] Test an empty-message submission.
- [ ] Open multiple conversations and confirm correct separation.

## Error handling

- [ ] Stop MySQL and confirm that the application reports a connection failure.
- [ ] Submit malformed input and confirm that the application does not fail silently.
- [ ] Attempt an unsupported file upload.
- [ ] Confirm behaviour when an external map request fails.
- [ ] Review browser and PHP error output during testing.

## Known gaps

- Automated unit and integration tests are not currently included.
- Security testing was not comprehensive.
- The application was tested locally rather than in a production environment.
- Browser and device coverage was limited.
