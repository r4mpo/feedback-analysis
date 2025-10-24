<?php require_once __DIR__ . '/templates/header.php'; ?>

<div class="container">
  <!-- Header -->
  <header class="header">
    <div class="logo">
      <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="32" height="32" rx="8" fill="url(#gradient)" />
        <path d="M16 8L22 12V20L16 24L10 20V12L16 8Z" stroke="white" stroke-width="2" stroke-linejoin="round" />
        <defs>
          <linearGradient id="gradient" x1="0" y1="0" x2="32" y2="32">
            <stop offset="0%" stop-color="#6366f1" />
            <stop offset="100%" stop-color="#8b5cf6" />
          </linearGradient>
        </defs>
      </svg>
      <h1>Feedback Analysis</h1>
    </div>
    <div class="header-stats">
      <div class="stat-item">
        <span class="stat-label">Total Analyzed</span>
        <span class="stat-value" id="totalAnalyzed">0</span>
      </div>
      <div class="stat-item">
        <span class="stat-label">Average Sentiment</span>
        <span class="stat-value" id="avgSentiment">-</span>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="main-content">
    <!-- Input Section -->
    <section class="input-section">
      <div class="card">
        <h2 class="section-title">Analyze New Feedback</h2>
        <form id="feedbackForm" class="feedback-form" onsubmit="return false;">
          <div class="form-group">
            <label for="feedbackText">Feedback Text</label>
            <textarea id="feedbackText" name="feedbackText" rows="5"
              placeholder="Type or paste the customer's feedback here..." required></textarea>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 3V17M10 17L15 12M10 17L5 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              Analyze Sentiment
            </button>
            <button type="button" class="btn btn-secondary" id="clearBtn">
              Clear
            </button>
          </div>
        </form>
      </div>
    </section>

    <!-- Results Section -->
    <section class="results-section">
      <div class="card">
        <h2 class="section-title">Analysis Result</h2>
        <div id="resultContainer" class="result-container">
          <div class="empty-state">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="32" cy="32" r="30" stroke="#e5e7eb" stroke-width="4" />
              <path d="M32 20V32L40 40" stroke="#9ca3af" stroke-width="4" stroke-linecap="round" />
            </svg>
            <p>No analysis performed yet</p>
            <span>Enter feedback above and click "Analyze Sentiment"</span>
          </div>
        </div>
      </div>
    </section>

    <!-- History Section -->
    <section class="history-section">
      <div class="card">
        <div class="section-header">
          <h2 class="section-title">Analysis History</h2>
          <button class="btn btn-text" id="clearHistoryBtn">Clear History</button>
        </div>
        <div id="historyContainer" class="history-container">
          <div class="empty-state">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="16" y="12" width="32" height="40" rx="2" stroke="#e5e7eb" stroke-width="4" />
              <line x1="24" y1="24" x2="40" y2="24" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round" />
              <line x1="24" y1="32" x2="40" y2="32" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round" />
              <line x1="24" y1="40" x2="32" y2="40" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round" />
            </svg>
            <p>No history available</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
      <div class="card">
        <h2 class="section-title">Overall Statistics</h2>
        <div class="stats-grid">
          <div class="stat-card positive">
            <div class="stat-icon">😊</div>
            <div class="stat-content">
              <span class="stat-number" id="positiveCount">0</span>
              <span class="stat-text">Positive</span>
            </div>
          </div>
          <div class="stat-card neutral">
            <div class="stat-icon">😐</div>
            <div class="stat-content">
              <span class="stat-number" id="neutralCount">0</span>
              <span class="stat-text">Neutral</span>
            </div>
          </div>
          <div class="stat-card negative">
            <div class="stat-icon">😞</div>
            <div class="stat-content">
              <span class="stat-number" id="negativeCount">0</span>
              <span class="stat-text">Negative</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/templates/footer.php'; ?>
