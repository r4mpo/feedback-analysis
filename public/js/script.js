// Feedback Analyzer JavaScript
// This is a demo implementation. In production, you would connect to a PHP backend using Transformers PHP

class FeedbackAnalyzer {
    constructor() {
        this.history = [];
        this.base_url = document.getElementById('base_url').value;
        this.stats = {
            positive: 0,
            neutral: 0,
            negative: 0
        };
        this.init();
    }

    init() {
        // Load history from localStorage
        this.loadHistory();

        // Event listeners
        document.getElementById('feedbackForm').addEventListener('submit', (e) => this.handleSubmit(e));
        document.getElementById('clearBtn').addEventListener('click', () => this.clearForm());
        document.getElementById('clearHistoryBtn').addEventListener('click', () => this.clearHistory());

        // Update UI
        this.updateStats();
        this.renderHistory();
    }

    analyzeSentiment(text) {
        return $.ajax({
            url: this.base_url + '/feedback-analysis',
            method: 'POST',
            data: { text },
            dataType: 'json',
            timeout: 120000
        });
    }

    async handleSubmit(e) {
        e.preventDefault();

        const textarea = document.getElementById('feedbackText');
        const text = textarea.value.trim();
        if (!text) return;

        this.showLoading();

        try {
            // Espera a Promise do $.ajax resolver
            const data = await this.analyzeSentiment(text);

            if (data.code != '000') {
                alert(data.message);
                return;
            }

            let result = {
                label: data.data.label,
                score: data.data.score
            };

            let entry = {
                id: Date.now(),
                text: text,
                sentiment: result.label,
                score: result.score,
                timestamp: new Date().toISOString()
            };

            this.history.unshift(entry);
            this.saveHistory();
            this.updateStatsCount(result.label);
            this.displayResult(entry);
            this.renderHistory();
            this.updateStats();

            textarea.value = '';
        } catch (error) {
            console.error('Error analyzing feedback:', error);
            alert('Error analyzing feedback. Please try again.');
        }
    }

    showLoading() {
        const container = document.getElementById('resultContainer');
        container.innerHTML = `
            <div class="empty-state loading">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="32" cy="32" r="30" stroke="#e5e7eb" stroke-width="4"/>
                    <path d="M32 20V32L40 40" stroke="#6366f1" stroke-width="4" stroke-linecap="round"/>
                </svg>
                <p>Analyzing feedback...</p>
            </div>
        `;
    }

    displayResult(entry) {
        const container = document.getElementById('resultContainer');
        const sentimentLabel = this.getSentimentLabel(entry.sentiment);
        const sentimentClass = entry.sentiment.toLowerCase();

        container.innerHTML = `
            <div class="result-card">
                <div class="result-header">
                    <span class="sentiment-badge ${sentimentClass}">
                        ${this.getSentimentEmoji(entry.sentiment)} ${sentimentLabel}
                    </span>
                    <span class="confidence-score">Confidence: ${(entry.score * 100).toFixed(1)}%</span>
                </div>
                <div class="feedback-text">${this.escapeHtml(entry.text)}</div>
            </div>
        `;
    }

    renderHistory() {
        const container = document.getElementById('historyContainer');

        if (this.history.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="16" y="12" width="32" height="40" rx="2" stroke="#e5e7eb" stroke-width="4"/>
                        <line x1="24" y1="24" x2="40" y2="24" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round"/>
                        <line x1="24" y1="32" x2="40" y2="32" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round"/>
                        <line x1="24" y1="40" x2="32" y2="40" stroke="#e5e7eb" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                    <p>No history available</p>
                </div>
            `;
            return;
        }

        const historyHTML = this.history.map(entry => `
            <div class="history-item" onclick="feedbackAnalyzer.showHistoryDetail(${entry.id})">
                <div class="history-header">
                    <span class="sentiment-badge ${entry.sentiment.toLowerCase()}">
                        ${this.getSentimentEmoji(entry.sentiment)} ${this.getSentimentLabel(entry.sentiment)}
                    </span>
                    <span class="confidence-score">${(entry.score * 100).toFixed(1)}%</span>
                </div>
                <div class="history-text">${this.escapeHtml(entry.text)}</div>
                <div class="history-time">${this.formatTime(entry.timestamp)}</div>
            </div>
        `).join('');

        container.innerHTML = historyHTML;
    }

    showHistoryDetail(id) {
        const entry = this.history.find(e => e.id === id);
        if (entry) {
            this.displayResult(entry);
        }
    }

    updateStatsCount(sentiment) {
        if (sentiment === 'POSITIVE') {
            this.stats.positive++;
        } else if (sentiment === 'NEGATIVE') {
            this.stats.negative++;
        } else {
            this.stats.neutral++;
        }
    }

    updateStats() {
        document.getElementById('positiveCount').textContent = this.stats.positive;
        document.getElementById('neutralCount').textContent = this.stats.neutral;
        document.getElementById('negativeCount').textContent = this.stats.negative;

        const total = this.stats.positive + this.stats.neutral + this.stats.negative;
        document.getElementById('totalAnalyzed').textContent = total;

        if (total > 0) {
            const avgSentiment = ((this.stats.positive - this.stats.negative) / total * 100).toFixed(0);
            document.getElementById('avgSentiment').textContent = `${avgSentiment > 0 ? '+' : ''}${avgSentiment}%`;
        } else {
            document.getElementById('avgSentiment').textContent = '-';
        }
    }

    clearForm() {
        document.getElementById('feedbackText').value = '';
    }

    clearHistory() {
        if (confirm('Are you sure you want to clear all history?')) {
            this.history = [];
            this.stats = {
                positive: 0,
                neutral: 0,
                negative: 0
            };
            this.saveHistory();
            this.renderHistory();
            this.updateStats();

            const container = document.getElementById('resultContainer');
            container.innerHTML = `
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="32" cy="32" r="30" stroke="#e5e7eb" stroke-width="4"/>
                        <path d="M32 20V32L40 40" stroke="#9ca3af" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                    <p>No analysis performed yet</p>
                    <span>Type feedback above and click "Analyze Sentiment"</span>
                </div>
            `;
        }
    }

    saveHistory() {
        localStorage.setItem('feedbackHistory', JSON.stringify(this.history));
        localStorage.setItem('feedbackStats', JSON.stringify(this.stats));
    }

    loadHistory() {
        const savedHistory = localStorage.getItem('feedbackHistory');
        const savedStats = localStorage.getItem('feedbackStats');

        if (savedHistory) {
            this.history = JSON.parse(savedHistory);
        }

        if (savedStats) {
            this.stats = JSON.parse(savedStats);
        }
    }

    getSentimentLabel(sentiment) {
        const labels = {
            'POSITIVE': 'Positive',
            'NEGATIVE': 'Negative',
            'NEUTRAL': 'Neutral'
        };
        return labels[sentiment] || sentiment;
    }

    getSentimentEmoji(sentiment) {
        const emojis = {
            'POSITIVE': '😊',
            'NEGATIVE': '😞',
            'NEUTRAL': '😐'
        };
        return emojis[sentiment] || '😐';
    }

    formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = now - date;

        const minutes = Math.floor(diff / 60000);
        const hours = Math.floor(diff / 3600000);
        const days = Math.floor(diff / 86400000);

        if (minutes < 1) return 'Just now';
        if (minutes < 60) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
        if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
        if (days < 7) return `${days} day${days > 1 ? 's' : ''} ago`;

        return date.toLocaleDateString('en-US');
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize the app
let feedbackAnalyzer;
document.addEventListener('DOMContentLoaded', () => {
    feedbackAnalyzer = new FeedbackAnalyzer();
});
