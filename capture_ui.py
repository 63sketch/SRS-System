import subprocess
import time
import os
from playwright.sync_api import sync_playwright

def capture():
    # Start Laravel
    print("Starting server...")
    server = subprocess.Popen(['php', 'artisan', 'serve', '--host=127.0.0.1', '--port=3000'],
                             stdout=subprocess.PIPE, stderr=subprocess.STDOUT)

    time.sleep(8) # Allow more time for Laravel to boot

    with sync_playwright() as p:
        print("Launching browser...")
        browser = p.chromium.launch(headless=True)
        context = browser.new_context()
        page = context.new_page()

        try:
            # 1. Welcome Page
            print("Capturing Welcome Page...")
            page.goto("http://127.0.0.1:3000", timeout=30000)
            page.screenshot(path="welcome.png")

            # 2. Login Page
            print("Capturing Login Page...")
            page.goto("http://127.0.0.1:3000/login", timeout=30000)
            page.screenshot(path="login.png")

            # 3. Perform Login
            print("Attempting Login...")
            page.fill('input[name="email"]', "admin@birrama.com")
            page.fill('input[name="password"]', "password")
            page.click('button[type="submit"]')
            time.sleep(5)

            # 4. Handle Force Reset
            if "force-password-reset" in page.url:
                print("Force reset detected, bypassing...")
                page.screenshot(path="force_reset.png")
                page.fill('input[name="password"]', "NewPassword123!")
                page.fill('input[name="password_confirmation"]', "NewPassword123!")
                page.click('button[type="submit"]')
                time.sleep(5)

            # 5. Dashboard
            print("Capturing Dashboard...")
            page.screenshot(path="dashboard.png")

            # 6. Reports
            print("Capturing Reports...")
            page.goto("http://127.0.0.1:3000/reports")
            time.sleep(3)
            page.screenshot(path="reports.png")

            print("Successfully captured all screens.")

        except Exception as e:
            print(f"Error during capture: {e}")
            page.screenshot(path="error_capture.png")
        finally:
            browser.close()
            server.terminate()
            print("Server terminated.")

if __name__ == "__main__":
    capture()
