@extends('frontend.master')

@section('content')

    <?php $type = isset($_GET['type']) ? "?type=rent_out" : ""; ?>
    <style>
        /* Theme Variables */
        :root {
            --primary-color: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            --accent-color: linear-gradient(135deg, #4a8c52 0%, #6bb26f 25%, #8fd19e 50%, #6bb26f 75%, #4a8c52 100%);
        }

        /* Base styles */
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .colorDefinition {
            background: #ffffff !important;
            color: var(--primary-color) !important;
            border-color: var(--primary-color);
            font-size: 12px;
        }

        .colorDefinition1 {
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.05em;
            color: var(--primary-color) !important;
            text-transform: uppercase;
        }

        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 0px solid #dee2e6;
        }

        .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 0.50rem;
        }

        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        /* Modern Page Styling */
        .modern-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin: 10px auto;
            max-width: 1200px;
        }

        .plaza-header {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            border-radius: 6px;
            padding: 8px 15px;
            color: white;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(45, 106, 47, 0.3), 0 4px 15px rgba(0, 0, 0, 0.1);
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .plaza-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #8fd19e, #66bb6a, #4caf50);
            border-radius: 6px 6px 0 0;
            opacity: 1;
            transition: all 0.3s ease;
        }

        /* Ensure sticky works across all browsers */
        .plaza-header {
            position: -webkit-sticky; /* Safari */
            position: sticky; /* Standard */
        }

        /* Mobile sticky fix - ensure mobile menu appears above plaza-header */
        @media (max-width: 768px) {
            .plaza-header {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                left: 0;
                right: 0;
                width: 100%;
                z-index: 5 !important;
            }
        }

        .plaza-header.scrolled {
            padding: 6px 15px;
            box-shadow: 0 4px 12px rgba(45, 106, 47, 0.4), 0 6px 20px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #1e4a20 0%, #2d6a2f 25%, #4a8c52 50%, #2d6a2f 75%, #1e4a20 100%);
            border-radius: 0 0 6px 6px;
            margin-bottom: 0;
        }

        .plaza-header.scrolled::before {
            height: 2px;
            background: linear-gradient(90deg, #66bb6a, #4caf50, #8fd19e);
        }

        .plaza-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex: 1;
        }

        .plaza-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
            color: #ffffff !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .plaza-subtitle {
            font-size: 11px;
            opacity: 0.9;
            margin: 2px 0 0 0;
            color: #ffffff !important;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .plaza-center {
            display: flex;
            justify-content: center;
            flex: 1;
        }

        .countdown-container {
            background: linear-gradient(135deg, #e8f5e8, #f0f8f0);
            border-radius: 4px;
            padding: 4px 12px;
            text-align: center;
            border: 1px solid #6bb26f;
            box-shadow: 0 2px 6px rgba(45, 106, 47, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.3);
            min-width: 110px;
        }

        .countdown-label {
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
            opacity: 1;
            color: #2d6a2f !important;
            text-shadow: none;
        }

        .countdown-timer {
            font-size: 25px;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            color: #1e4a20 !important;
            line-height: 1.1;
            text-shadow: none;
        }

        .plaza-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: flex-end;
        }

        .header-bid-input {
            width: 120px;
            padding: 4px 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            font-size: 12px;
        }

        .header-bid-input:focus {
            outline: none;
            border-color: white;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        .header-bid-btn {
            padding: 4px 12px;
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-bid-btn:hover {
            background: linear-gradient(135deg, #4a8c52 0%, #6bb26f 25%, #8fd19e 50%, #6bb26f 75%, #4a8c52 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Property Table Styling */
        .property-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            border: none;
        }

        .property-item.property-col-list {
            background: transparent;
            border: none;
            margin-bottom: 0;
            display: table-row;
            transition: all 0.3s ease;
        }

        .property-item.property-col-list:hover {
            background: rgba(168, 195, 86, 0.05);
        }

        .property-row {
            display: table-row;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .property-row:last-child {
            border-bottom: none;
        }

        .property-row:hover {
            background: rgba(168, 195, 86, 0.05);
        }

        .property-cell {
            display: table-cell;
            vertical-align: middle;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .property-cell:last-child {
            border-right: none;
        }

        /* Compact Property Image */
        .property-image-cell {
            width: 120px;
            padding: 10px !important;
        }

        .property-image-compact {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            height: 80px;
            width: 100px;
        }

        .property-image-compact img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .property-image-compact:hover img {
            transform: scale(1.05);
        }

        /* Mobile image size adjustments */
        @media (max-width: 768px) {
            .img-fluid {
                max-width: 40% !important;
                height: auto !important;
            }
            
            .modern-property-image img {
                max-width: 40% !important;
                height: auto !important;
                margin: 0 auto !important;
                display: block !important;
            }
        }

        @media (max-width: 480px) {
            .img-fluid {
                max-width: 40% !important;
                height: auto !important;
            }
            
            .modern-property-image img {
                max-width: 40% !important;
                height: auto !important;
                margin: 0 auto !important;
                display: block !important;
            }
        }

        .property-lable {
            position: absolute;
            top: 5px;
            left: 5px;
            z-index: 2;
        }

        .property-lable .badge {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(45, 106, 47, 0.4);
        }

        /* Property Details Cell */
        .property-details-cell {
            min-width: 300px;
        }

        .property-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .property-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .property-title a {
            color: #2c3e50;
            text-decoration: none;
        }

        .property-title a:hover {
            color: #4a8c52;
        }

        .property-price {
            font-size: 14px;
            font-weight: 700;
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .property-info-compact {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .property-info-item {
            display: flex;
            align-items: center;
            font-size: 11px;
            color: #555;
            margin-bottom: 4px;
        }

        .property-info-item i {
            width: 14px;
            margin-right: 6px;
            color: #4a8c52;
            font-size: 10px;
        }

        .property-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 8px;
        }

        .property-badges .label {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .property-badges .label-success {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            opacity: 0.9;
        }

        .property-badges .label-primary {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            opacity: 0.8;
        }

        .property-badges .label-warning {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            opacity: 0.7;
        }

        .property-badges .label:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(168, 195, 86, 0.3);
        }

        /* Responsive Bid Section */
        .bid-cell {
            min-width: 280px;
            padding: 10px !important;
        }

        .bid-section-compact {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            border-radius: 8px;
            padding: 15px;
            color: white;
        }

        .bid-input-container {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 12px;
            backdrop-filter: blur(10px);
        }

        .bid-input-group {
            display: flex;
            gap: 8px;
            align-items: stretch;
            margin-bottom: 8px;
        }

        .bid-input-group .form-control {
            flex: 1;
            min-width: 120px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }

        .bid-input-group .form-control:focus {
            border-color: white;
            outline: none;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .bid-input-group .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            color: white;
            transition: all 0.3s ease;
            min-width: 80px;
        }

        .bid-input-group .btn:hover {
            background: linear-gradient(135deg, #4a8c52 0%, #6bb26f 25%, #8fd19e 50%, #6bb26f 75%, #4a8c52 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(45, 106, 47, 0.2);
        }

        .words-display {
            font-size: 10px;
            font-weight: bold;
            color: rgba(28, 26, 26, 0.9);
            font-style: italic;
            min-height: 14px;
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* Modern Bid Input Group Styles */
        .modern-bid-input-group {
            margin-bottom: 8px;
        }

        .bid-amount-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .currency-symbol {
            position: absolute;
            left: 12px;
            z-index: 2;
            color: #4a8c52;
            font-weight: 700;
            font-size: 16px;
        }

        .modern-bid-input {
            width: 100%;
            padding: 12px 12px 12px 35px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            background: #fff;
            color: #2c3e50;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .modern-bid-input:focus {
            border-color: #4a8c52;
            outline: none;
            box-shadow: 0 0 0 3px rgba(45, 106, 47, 0.1);
            transform: translateY(-1px);
        }

        .modern-bid-input::placeholder {
            color: #adb5bd;
            font-weight: 400;
        }

        .modern-place-bid-btn {
            background: linear-gradient(135deg, #2d6a2f 0%, #4a8c52 25%, #6bb26f 50%, #4a8c52 75%, #2d6a2f 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            color: white;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(45, 106, 47, 0.3);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modern-place-bid-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 106, 47, 0.4);
            background: linear-gradient(135deg, #4a8c52 0%, #6bb26f 25%, #8fd19e 50%, #6bb26f 75%, #4a8c52 100%);
        }

        .modern-place-bid-btn:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(45, 106, 47, 0.3);
        }

        .modern-place-bid-btn i {
            font-size: 14px;
        }

        .modern-place-bid-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .modern-place-bid-btn:hover::before {
            left: 100%;
        }

        /* Mobile Responsive Table */
        @media (max-width: 992px) {
            .modern-container {
                margin: 10px;
                padding: 15px;
            }

            .plaza-title {
                font-size: 16px;
            }

            .countdown-container {
                padding: 3px 10px;
                min-width: 95px;
            }

            .countdown-label {
                font-size: 7px;
            }

            .countdown-timer {
                font-size: 10px;
            }

            .property-cell {
                padding: 12px 10px;
            }

            .property-image-compact {
                height: 70px;
                width: 90px;
            }

            .property-image-compact img {
                height: 70px;
            }
        }

        @media (max-width: 768px) {
            .modern-container {
                margin: 5px;
                padding: 10px;
            }

            .plaza-header {
                padding: 8px 10px;
                flex-wrap: wrap;
                gap: 8px;
            }

            .plaza-header.scrolled {
                padding: 6px 10px;
            }

            .plaza-left, .plaza-center, .plaza-right {
                flex: none;
            }

            .plaza-left {
                order: 1;
                width: 100%;
                text-align: center;
                margin-bottom: 8px;
            }

            .plaza-center {
                order: 2;
                width: 100%;
                display: flex;
                justify-content: center;
                margin-bottom: 8px;
            }

            .plaza-right {
                order: 3;
                width: 100%;
                justify-content: center;
                margin-top: 0;
            }

            /* Ensure scrolled header content stays centered in mobile */
            .plaza-header.scrolled .plaza-left {
                text-align: center !important;
            }

            .plaza-header.scrolled .plaza-center {
                justify-content: center !important;
            }

            .plaza-header.scrolled .plaza-right {
                justify-content: center !important;
            }

            .plaza-title {
                font-size: 14px;
                text-align: center !important;
            }

            .plaza-subtitle {
                font-size: 10px;
                text-align: center !important;
            }

            .countdown-container {
                padding: 3px 10px;
                min-width: 90px;
                margin: 0 auto;
            }

            .countdown-label {
                font-size: 7px;
            }

            .countdown-timer {
                font-size: 9px;
            }

            .header-bid-input {
                width: 100px;
                font-size: 11px;
            }

            .header-bid-btn {
                font-size: 11px;
                padding: 4px 10px;
            }

            /* Stack table cells vertically on mobile */
            .property-table,
            .property-row,
            .property-cell {
                display: block !important;
                width: 100% !important;
            }

            .property-cell {
                border-bottom: none !important;
                border-right: none !important;
                padding: 8px !important;
                text-align: center !important;
            }

            .property-image-cell {
                width: 100% !important;
                text-align: center;
                padding: 10px !important;
            }

            .property-image-compact {
                height: 100px;
                width: 120px;
                margin: 0 auto;
            }

            .property-image-compact img {
                height: 100px;
            }

            .bid-cell {
                min-width: 100% !important;
            }

            .bid-input-group {
                flex-direction: column !important;
                gap: 8px !important;
            }

            .bid-input-group .form-control {
                min-width: 100% !important;
            }

            .bid-input-group .btn {
                min-width: 100% !important;
            }

            /* Property Details Mobile Centering */
            .property-details-cell,
            .modern-property-details {
                text-align: center !important;
            }

            .property-title {
                text-align: center !important;
            }

            .property-price {
                text-align: center !important;
            }

            .property-info-grid {
                text-align: center !important;
            }

            .property-info-item {
                text-align: center !important;
                justify-content: center !important;
            }

            .property-badges {
                text-align: center !important;
                justify-content: center !important;
            }

            /* Modern Bid Input Mobile Styles */
            .bid-amount-container {
                padding: 12px !important;
            }

            .modern-bid-input {
                font-size: 14px !important;
                padding: 10px 10px 10px 30px !important;
            }

            .currency-symbol {
                font-size: 14px !important;
                left: 10px !important;
            }

            .modern-place-bid-btn {
                padding: 10px 16px !important;
                font-size: 12px !important;
            }

            .modern-place-bid-btn i {
                font-size: 12px !important;
            }
        }

        @media (max-width: 480px) {
            .modern-container {
                margin: 0;
                padding: 8px;
                border-radius: 0;
            }

            .plaza-header {
                padding: 5px 10px;
            }

            .plaza-header.scrolled {
                padding: 4px 10px;
            }

            /* Ensure scrolled header content stays centered in small mobile */
            .plaza-header.scrolled .plaza-left {
                text-align: center !important;
            }

            .plaza-header.scrolled .plaza-center {
                justify-content: center !important;
            }

            .plaza-header.scrolled .plaza-right {
                justify-content: center !important;
            }

            .plaza-title {
                font-size: 13px;
                text-align: center !important;
            }

            .plaza-subtitle {
                font-size: 9px;
                margin-bottom: 4px;
                text-align: center !important;
            }

            .property-title {
                font-size: 14px;
                text-align: center !important;
            }

            .property-price {
                font-size: 12px;
                text-align: center !important;
            }

            .property-info-item {
                font-size: 10px;
                text-align: center !important;
                justify-content: center !important;
            }

            .property-badges {
                text-align: center !important;
                justify-content: center !important;
            }

            .property-badges .label {
                font-size: 9px;
                padding: 3px 6px;
            }
        }

        @media (max-width: 480px) {
            .modern-container {
                margin: 0;
                padding: 10px;
                border-radius: 0;
            }

            /* Ensure scrolled header content stays centered in small mobile */
            .plaza-header.scrolled .plaza-left {
                text-align: center !important;
            }

            .plaza-header.scrolled .plaza-center {
                justify-content: center !important;
            }

            .plaza-header.scrolled .plaza-right {
                justify-content: center !important;
            }

            .property-info-item {
                font-size: 13px;
                text-align: center !important;
                justify-content: center !important;
            }

            .property-title {
                text-align: center !important;
            }

            .property-price {
                text-align: center !important;
            }

            .property-badges {
                text-align: center !important;
                justify-content: center !important;
            }

            .countdown-container {
                padding: 2px 8px !important;
                min-width: 80px !important;
            }

            .countdown-label {
                font-size: 6px;
            }

            .countdown-timer {
                font-size: 8px;
            }
        }

        .size_lg {
    font-size: 19px !important;
    border-width: 0px;
    border-radius: 5px;
}
    </style>
    <!--=================================
    Listing – grid view -->
    <section style="padding: 10px 0; min-height: 100vh;">
        <div class="modern-container">
            <!-- Plaza Header with Countdown -->
            <div class="plaza-header">
                <div class="plaza-left">
                    <!-- <p class="" style="text-align:center !important">{{$plaza_details->name ?? "Property Auction"}}</p> -->
                    
                </div>
                <div class="plaza-center">
                    <div class="countdown-container">
                        <div class="countdown-label">Days:Hr:Min:Sec</div>
                        <div id="given_date" class="countdown-timer"></div>
                    </div>
                </div>
                <div class="plaza-right">

                </div>
            </div>
            <!-- Property Cards Grid -->
            <div class="row">
                <div class="col-12">
                    @foreach($data as $key => $value)
                        <div class="property-item property-col-list">
                            <div class="row no-gutters align-items-stretch">
                                <!-- Property Image -->
                                <div class="col-lg-4 col-md-5">
                                    <div class="modern-property-image">
                                        <img class="img-fluid" src="{{url("/")."/".$value->attachment}}" alt="{{$value->shop_name}}">
                                        <div class="property-lable">
                                            <span class="badge badge-md badge-primary">{{($value->property_type == "plaza") ? "shop" : "plot"}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Property Details -->
                                <div class="col-lg-8 col-md-7">
                                    <div class="row h-100">
                                        <!-- Property Information -->
                                        <div class="col-lg-7 col-md-12">
                                            <div class="modern-property-details">
                                                <h4 class="property-title">
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}">{{$value->shop_name}}</a>
                                                </h4>

                                                <div class="property-price blink_me">
                                                    {{$value->premium}} {{--/{{$value->future_use}}--}} in PKR
                                                </div>

                                                <div class="property-info-grid">
                                                    <div class="property-info-item">
                                                        <i class="far fa-building"></i>
                                                        <span class="property-m-sqft">{{$value->org_name}}</span>
                                                    </div>
                                                    <div class="property-info-item">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <span class="property-address">{{$value->location}}</span>
                                                    </div>
                                                    <div class="property-info-item">
                                                        <i class="far fa-square"></i>
                                                        <span class="property-m-sqft">Total area: {{$value->coveredarea}} sqft</span>
                                                    </div>
                                                </div>

                                                <div class="property-badges">
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}" class="label label-success">Details</a>
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}" class="label label-primary">Participants ({{$value->totalBidders}})</a>
                                                    <a href="{{url("details")."/$auction_id/$value->plaza_id/$value->id".$type}}" class="label label-warning">Bids Received ({{$value->totalBidds}})</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bidding Section -->
                                        <div class="col-lg-5 col-md-12">
                                            @if($show_clock)
                                                <div class="modern-bid-section h-100 d-flex align-items-center">
                                                    <div class="bid-input-container w-100">
                                                        <table class="table submit_bid_amount" style="margin: 0;">
                                                            <tr>
                                                                <td style="padding: 0; border: none;">
                                                                    <div class="modern-bid-input-group">
                                                                        <div class="bid-amount-container">
                                                                            <div class="input-wrapper">
                                                                                <span class="currency-symbol">₨</span>
                                                                                <input type="number"
                                                                                       onkeyup="word.innerHTML=convertNumberToWords(this.value)"
                                                                                       id="input_{{$value->id}}"
                                                                                       class="form-control entered_amount modern-bid-input"
                                                                                       placeholder="Enter your bid amount"
                                                                                       min="1">
                                                                            </div>
                                                                            <button type="button"
                                                                                    class="btn modern-place-bid-btn place_bid"
                                                                                    shp_id="{{$value->id}}"
                                                                                    auction_id="{{$auction_id}}">
                                                                                <i class="fas fa-gavel"></i>
                                                                                <span>Place Bid</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div id="word" class="words-display"></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> <!-- End modern-container -->
    </section>

    <div id="submit_cdr_confirmation" class="modal fade" id="submit_cdr_confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Confirmation</h5>
                    <button type="button" class="close close_popup" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message box_message">
                    Please submit your CDR for this auction.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn_pub_yes" data-bs-dismiss="modal">Okay</button>

                </div>
            </div>
        </div>
    </div>


    <div id="confirm_place_bid" class="modal fade" id="submit_cdr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body alert_message box_message">

                </div>
                <div class="modal-body alert_message amount_in_figure">

                </div>
                <div class="modal-body alert_message amount_in_text">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success place_yes" data-bs-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger btn_cancel" data-bs-dismiss="modal">No</button>

                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Try to load the original countdown timer -->
    <script type="text/javascript" src="http://www.eauction.lcbkp.gov.pk/js/jquery.countdownTimer.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.eauction.lcbkp.gov.pk/js/jquery.countdownTimer.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.css" integrity="sha512-IScV5kvJo+TIPbxENerxZcEpu9VrLUGh1qYWv6Z9aylhxWE4k4Fch3CHl0IYYmN+jrnWQBPlpoTVoWfSMakoKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.js" integrity="sha512-CyYoxe9EczMRzqO/LsqGsDbTl3wBj9lvLh6BYtXzVXZegJ8VkrKE90fVZOk1BNq3/9pyg+wn+TR3AmDuRjjiRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Fallback countdown timer implementation -->
    <script>
        // Custom countdown timer fallback
        if (typeof $.fn.countdowntimer === 'undefined') {
            $.fn.countdowntimer = function(options) {
                var settings = $.extend({
                    startDate: new Date(),
                    dateAndTime: new Date(),
                    size: "lg",
                    timeUp: function() {}
                }, options);

                var element = this;
                var endTime = new Date(settings.dateAndTime).getTime();
                
                function updateCountdown() {
                    var now = new Date().getTime();
                    var distance = endTime - now;
                    
                    if (distance < 0) {
                        element.html("EXPIRED");
                        settings.timeUp();
                        return;
                    }
                    
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    // Format with leading zeros
                    days = days.toString().padStart(2, '0');
                    hours = hours.toString().padStart(2, '0');
                    minutes = minutes.toString().padStart(2, '0');
                    seconds = seconds.toString().padStart(2, '0');
                    
                    element.html(days + ":" + hours + ":" + minutes + ":" + seconds);
                }
                
                // Update immediately and then every second
                updateCountdown();
                var interval = setInterval(updateCountdown, 1000);
                
                return this;
            };
        }
    </script>
    <!--=================================
    Listing – grid view -->

    <script>

        plaza_id = "{{request()->plaza_id}}";
        auction_id = "{{$auction_id}}";
        count = 0;
        page_type = "<?php echo $_GET['type'] ?? '' ?>";

        $(function(){
            if(page_type == ""){
                $("#given_date").countdowntimer({
                    startDate : "{{$auctionStartTime}}",
                    dateAndTime : "{{$auctionEndTime}}",
                    size:"lg",
                    timeUp : timeIsUp
                });
            }
            function timeIsUp() {

                $(".submit_bid_amount").remove();
                /*$.ajax({
                    method:"GET",
                    url:"{{url('makeAuctionExpired')}}/"+auction_id,
                    success:function(res){
                        window.location = BaseUrl+`/property-details/${auction_id}/${plaza_id}?type=rent_out`;

                    },
                    error: function (request, status, error) {
                        if(request.responseJSON.message == "Unauthenticated."){
                            window.location = BaseUrl+"/login";
                        }
                    }
                });*/
                $("body").hide();


                setTimeout(function () {
                    alert("Auction is expired");
                    //window.location = BaseUrl+`/property-details/${auction_id}/${plaza_id}?type=rent_out`;
                    // window.location = "{{route('completedAuctions')}}";
                },2000);

            }
        });



        $(document).ready(function(){
            // Sticky header scroll effect
            $(window).scroll(function() {
                var scrollTop = $(window).scrollTop();
                var header = $('.plaza-header');

                if (scrollTop > 50) {
                    header.addClass('scrolled');
                } else {
                    header.removeClass('scrolled');
                }
            });

            // Header bid functionality - shows message to select property first
            $("#header-place-bid").click(function() {
                var bidAmount = $("#header-bid-input").val();
                if (!bidAmount || bidAmount == 0) {
                    alert("Please enter a bid amount");
                    return;
                }
                alert("Please select a specific property below to place your bid");
            });

            $("body").on("click",".place_yes",function(e){
                // Hide the modal first
                $("#confirm_place_bid").modal("hide");

                $.ajax({
                    method:"POST",
                    url:"{{url('placeBid')}}",
                    data:{
                        shop_id:shp_id,
                        bid_amount:bid_amount,
                        auction_id:auction_id,
                        // _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(res){
                        $(".entered_amount").val("");
                        $(".entered_amount").val("");
                        if(res.status == "submit_full_cdr"){
                            $(".box_message").text("Please submit your CDR for this auction.");
                            $("#submit_cdr_confirmation").modal("show");

                            return false;
                        }else if(res.status == "min_bid"){
                            $.notify(res.message, 'error');
                            return false;
                        }else if(res.status == "expire"){
                            $.notify(res.message, 'error');
                            setTimeout(function(){
                                window.location.reload();
                            },5000);
                            return false;
                        }else{
                            $.notify(res.message, 'success');

                            setTimeout(function(){
                                window.location.reload();
                            },2000);

                        }
                    },
                    error: function (request, status, error) {
                        if(request.responseJSON && request.responseJSON.message == "Unauthenticated."){
                            window.location = "{{ url('/login') }}";
                        }
                        console.error('AJAX Error:', error);
                    }
                });
            });

            $("body").on("click",".btn_cancel",function(e){
                $("#confirm_place_bid").modal("hide");
            });


            $("body").on("click",".delete_yes",function(e){
                $.ajax({
                    method:"POST",
                    data:{id:delete_id},
                    url:'<?php echo url("/settings/delete-plaza-floor"); ?>',
                    success:function(res){
                        if(res.status){
                            window.location.reload();
                        }else{
                            $.notify(res.message, 'error');
                        }

                    }
                });

            });



            $("body").on("click",".btn_pub_yes",function(e){
                // Hide modal first
                $("#submit_cdr_confirmation").modal("hide");

                var url = "{{url('auctions/add-customer-cdr')}}/"+auction_id+"/"+shp_id;
                window.open(url, '_blank');
            });

            $("body").on("click",".close_popup",function(e){
                $("#submit_cdr_confirmation").modal("hide");
            });

            //getAuction_details(plaza_id);
            $("body").on("click",".place_bid",function(e){

                shp_id = $(this).attr("shp_id");
                auction_id = $(this).attr("auction_id");
                bid_amount = $("#input_"+shp_id).val();
                if(bid_amount.trim() == "" || bid_amount == 0){
                    return false;
                }
                words = convertNumberToWords(bid_amount);
                $(".box_message").text("Are you sure to place this bid ?");
                $(".amount_in_figure").html(`<b>Rs: ${bid_amount}</b>`);
                $(".amount_in_text").html(`<b>${words}</b>`);
                $("#confirm_place_bid").modal("show");

            }) ;
        });

        function getAuction_details(plaza_id) {
            setInterval(function () {
                $.ajax({
                    method:"GET",
                    url:"{{url('getPropertyDetails/')}}/"+plaza_id,
                    data:{plaza_id:plaza_id},
                    success:function(res){
                        if(count != 0){
                            console.log(res);
                        }else{
                            count = parseInt(count) + parseInt(1);
                        }

                    },
                    error: function (request, status, error) {

                    }
                });
            }, 30000);

        }


        function convertNumberToWords(amount) {
            var words = new Array();
            words[0] = '';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';
            amount = amount.toString();
            var atemp = amount.split(".");
            var number = atemp[0].split(",").join("");
            var n_length = number.length;
            var words_string = "";
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                value = "";
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + " ";
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Crores ";
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Lakhs ";
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Thousand ";
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += "Hundred and ";
                    } else if (i == 6 && value != 0) {
                        words_string += "Hundred ";
                    }
                }
                words_string = words_string.split("  ").join(" ");
            }
            console.log(words_string);
            return words_string;
        }

        // Enhanced Sticky Plaza Header Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const plazaHeader = document.querySelector('.plaza-header');
            const headerHeight = plazaHeader ? plazaHeader.offsetHeight : 0;
            let lastScrollY = window.scrollY;
            let ticking = false;

            function updateStickyHeader() {
                const scrollY = window.scrollY;
                
                if (plazaHeader) {
                    // Add scrolled class when header becomes sticky
                    if (scrollY > headerHeight) {
                        plazaHeader.classList.add('scrolled');
                    } else {
                        plazaHeader.classList.remove('scrolled');
                    }
                }
                
                lastScrollY = scrollY;
                ticking = false;
            }

            function onScroll() {
                if (!ticking) {
                    requestAnimationFrame(updateStickyHeader);
                    ticking = true;
                }
            }

            // Attach scroll event listener
            window.addEventListener('scroll', onScroll, { passive: true });

            // Initialize on load
            updateStickyHeader();

            // Ensure sticky positioning works on mobile devices
            if (plazaHeader) {
                plazaHeader.style.position = '-webkit-sticky';
                plazaHeader.style.position = 'sticky';
            }
        });

    </script>

@endsection